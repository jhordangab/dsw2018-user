<?php

namespace app\models\queries;

use Yii;
use app\models\CategoriaPadrao;

class CategoriaPadraoQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere('[[is_ativo]]=1');
    }
    
    public function exist()
    {
        return $this->andWhere('[[is_excluido]]=0');
    }
    
    public function all($db = null)
    {
        return parent::all($db);
    }

    public function one($db = null)
    {
        return parent::one($db);
    }
    
    public function getTree($db = null)
    {
        $pais = CategoriaPadrao::find()->andWhere(['is_ativo' => TRUE, 'is_excluido' => FALSE])->andWhere('codigo_pai is null')->orderBy('desc_codigo ASC')->all();
        $data_pais = [];
        
        foreach($pais as $pai)
        {
            $data_pais[$pai->codigo]['attributes'] = $pai->attributes;
            $filhos = CategoriaPadrao::find()->andWhere(['is_ativo' => TRUE, 'is_excluido' => FALSE, 'codigo_pai' => $pai->codigo])->orderBy('desc_codigo ASC')->all();
            $data_filhos = [];
            
            foreach($filhos as $filho)
            {
                $data_filhos[$filho->codigo]['attributes'] = $filho->attributes;
                $netos = CategoriaPadrao::find()->andWhere(['is_ativo' => TRUE, 'is_excluido' => FALSE, 'codigo_pai' => $filho->codigo])->orderBy('desc_codigo ASC')->all();
                $data_netos = [];
                
                foreach($netos as $neto)
                {
                    $data_netos[$neto->codigo]['attributes'] = $neto->attributes;
                    $bisnetos = CategoriaPadrao::find()->andWhere(['is_ativo' => TRUE, 'is_excluido' => FALSE, 'codigo_pai' => $neto->codigo])->orderBy('desc_codigo ASC')->all();
                    $data_bisnetos = [];
                    
                    foreach($bisnetos as $bisneto)
                    {
                        $data_bisnetos[$bisneto->codigo]['attributes'] = $bisneto->attributes;
                        $taranetos = CategoriaPadrao::find()->andWhere(['is_ativo' => TRUE, 'is_excluido' => FALSE, 'codigo_pai' => $bisneto->codigo])->orderBy('desc_codigo ASC')->all();
                        $data_taranetos = [];
                        
                        foreach($taranetos as $taraneto)
                        {
                            $data_taranetos[$taraneto->codigo]['attributes'] = $taraneto->attributes;
                            $tataranetos = CategoriaPadrao::find()->andWhere(['is_ativo' => TRUE, 'is_excluido' => FALSE, 'codigo_pai' => $taraneto->codigo])->orderBy('desc_codigo ASC')->all();
                            $data_tataranetos = [];
                            
                            foreach($tataranetos as $tataraneto)
                            {
                                $data_tataranetos[$tataraneto->codigo] = ['attributes' => $tataraneto->attributes, 'children' => []];
                            }
                            
                            $data_taranetos[$taraneto->codigo]['children'] = $data_tataranetos;
                        }
                        
                        $data_bisnetos[$bisneto->codigo]['children'] = $data_taranetos;
                    }
                    
                    $data_netos[$neto->codigo]['children'] = $data_bisnetos;
                }
                
                $data_filhos[$filho->codigo]['children'] = $data_netos;
            }
            
            $data_pais[$pai->codigo]['children'] = $data_filhos;
        }
        
        return $data_pais;
    }   
    
    public function getEmpresaTree($db = null, $empresa_id = null)
    {
        $pais = $this->getData();
        $data_pais = [];
        
        foreach($pais as $pai)
        {
            $data_pais[$pai->codigo]['attributes'] = $pai->attributes;
            $filhos = $this->getData($pai->codigo);
            $data_filhos = [];
            
            foreach($filhos as $filho)
            {
                $data_filhos[$filho->codigo]['attributes'] = $filho->attributes;
                $netos = $this->getData($filho->codigo);
                $data_netos = [];
                
                foreach($netos as $neto)
                {
                    $data_netos[$neto->codigo]['attributes'] = $neto->attributes;
                    $bisnetos = $this->getData($neto->codigo);
                    $data_bisnetos = [];
                    
                    foreach($bisnetos as $bisneto)
                    {
                        $data_bisnetos[$bisneto->codigo]['attributes'] = $bisneto->attributes;
                        $taranetos = $this->getData($bisneto->codigo);
                        $data_taranetos = [];
                        
                        foreach($taranetos as $taraneto)
                        {
                            $data_taranetos[$taraneto->codigo]['attributes'] = $taraneto->attributes;
                            $tataranetos = $this->getData($taraneto->codigo);
                            $data_tataranetos = [];
                            
                            foreach($tataranetos as $tataraneto)
                            {
                                $data_tataranetos[$tataraneto->codigo] = ['attributes' => $tataraneto->attributes, 'children' => []];
                            }
                            
                            $data_taranetos[$taraneto->codigo]['children'] = $data_tataranetos;
                        }
                        
                        $data_bisnetos[$bisneto->codigo]['children'] = $data_taranetos;
                    }
                    
                    $data_netos[$neto->codigo]['children'] = $data_bisnetos;
                }
                
                $data_filhos[$filho->codigo]['children'] = $data_netos;
            }
            
            $data_pais[$pai->codigo]['children'] = $data_filhos;
        }
        
        return $data_pais;
    }   
    
    public function getData($pai_id = null, $empresa_id = null)
    {
        $query1 = (new \yii\db\Query())
            ->select("codigo_pai, codigo, desc_codigo, descricao, is_service")
            ->from('categoria_padrao')
            ->andWhere(
            [
                'is_ativo' => TRUE,
                'is_excluido' => FALSE,
            ]);
        
        $query2 = (new \yii\db\Query())
            ->select("codigo_pai, codigo, desc_codigo, descricao, is_service")
            ->from('categoria_empresa')
            ->andWhere(
            [
                'is_ativo' => TRUE,
                'is_excluido' => FALSE,
                'empresa_id' => ($empresa_id) ? $empresa_id : Yii::$app->user->identity->empresa_id
            ]);
        
        if($pai_id)
        {
            $query1->andWhere(['codigo_pai' => $pai_id]);
            $query2->andWhere(['codigo_pai' => $pai_id]);
        }
        else
        {
            $query1->andWhere('codigo_pai is null');
            $query2->andWhere('codigo_pai is null');
        }

        $query1->union($query2, true);
        $sql = $query1->createCommand()->getRawSql();
        $sql .= ' ORDER BY desc_codigo ASC';
        
        return CategoriaPadrao::findBySql($sql)->all();
    }
}
