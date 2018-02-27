<?php

namespace app\models;

use Yii;
use moonland\phpexcel\Excel;

class BalanceteImportForm extends yii\base\Model
{
    public $mes;
    
    public $ano;
    
    public $file;
            
    public function rules()
    {
        return 
        [
            [['file', 'mes', 'ano'], 'required'],
            [['file'], 'file', 'extensions' => 'xls, xlsx, ods'],
            ['ano', 'validateBalancete']
        ];
    }
    
    public function attributeLabels()
    {
        return 
        [
            'file' => 'Arquivo',
        ];
    }
    
    public function validateBalancete($attribute, $params, $validator)
    {
        $find = Balancete::find()->andWhere(
        [
            'mes' => $this->mes, 
            'ano' => $this->ano, 
            'empresa_id' => Yii::$app->user->identity->empresa_id,
            'is_ativo' => TRUE, 
            'is_excluido' => FALSE
        ])->exists();
        
        if ($find) 
        {
            $this->addError('mes', 'O balancete já foi importado para o período selecionado.');
        }
    }
    
    public function save()
    {
        $time = time();
        $file_path = 'csv/balancete/';
        $file = $time. '.' . $this->file->extension;
        
        if (!file_exists($file_path)) 
        {
            mkdir($file_path, 0777, true);
        }
        
        $this->file->saveAs($file_path . $file);

        $data = Excel::import($file_path . $file);

        $empresa_id = Yii::$app->user->identity->empresa_id;
        
        $balancete = new Balancete();
        $balancete->empresa_id = $empresa_id;
        $balancete->mes = $this->mes;
        $balancete->ano = $this->ano;
        $balancete->save();
        
        foreach($data[0] as $value)
        {
            $codigo = $this->alteraCategoria(str_replace([',', '.'], '', trim($value['Conta Contábil'])));
            $categoria = $value['Nomenclatura da Conta'];
            $valor = $value['Saldo do Mês'];
            
            $this->salvarDados($balancete->id, $empresa_id, $codigo, $categoria, $valor);
        }
        
        return true;
    }
    
    public function salvarDados($balancete_id, $empresa_id, $desc_codigo, $desc_categoria, $valor)
    {
        $categoria = CategoriaPadrao::findOne(['desc_codigo' => $desc_codigo]);
        $codigo = (integer) str_replace('.', '', $desc_codigo);
        
        if(!$categoria)
        {
            $categoria = CategoriaEmpresa::findOne(['desc_codigo' => $desc_codigo, 'empresa_id' => $empresa_id]);

            if(!$categoria)
            {
                $categoria = new CategoriaEmpresa();
                $categoria->empresa_id = $empresa_id;
                $categoria->codigo = $codigo;
                $categoria->desc_codigo = $desc_codigo;
                $categoria->descricao = $desc_categoria;
                $categoria->codigo_pai = $this->getCodigoPai($codigo);
                $categoria->is_service = (strlen($codigo) > 6);
                $categoria->save();
            }
        }
        
        $balancete_valor = new BalanceteValor();
        $balancete_valor->balancete_id = $balancete_id;
        $balancete_valor->categoria_id = $codigo;
        $balancete_valor->valor = $valor;
        $balancete_valor->save();
    }
    
    public function alteraCategoria($codigo)
    {
        if (strpos($codigo, '.') !== true)
        {
            switch (strlen($codigo))
            {
                case 1:
                    return $codigo;
                case 2:
                    return substr($codigo, 0, 1) . '.' . substr($codigo, 1, 1);
                case 3:
                    return substr($codigo, 0, 1) . '.' . substr($codigo, 1, 1) .
                        '.' . substr($codigo, 2, 1);
                case 4:
                    return substr($codigo, 0, 1) . '.' . substr($codigo, 1, 1) .
                        '.' . substr($codigo, 2, 1) . '.' . substr($codigo, 3, 1);
                case 6:
                    return substr($codigo, 0, 1) . '.' . substr($codigo, 1, 1) .
                        '.' . substr($codigo, 2, 1) . '.' . substr($codigo, 3, 1) .
                            '.' . substr($codigo, 4, 2);
                case 7:
                    return substr($codigo, 0, 1) . '.' . substr($codigo, 1, 1) .
                        '.' . substr($codigo, 2, 1) . '.' . substr($codigo, 3, 1) .
                            '.' . substr($codigo, 4, 2) . '.' . substr($codigo, 6, 1);
                case 8:
                    return substr($codigo, 0, 1) . '.' . substr($codigo, 1, 1) .
                        '.' . substr($codigo, 2, 1) . '.' . substr($codigo, 3, 1) .
                            '.' . substr($codigo, 4, 2) . '.' . substr($codigo, 6, 2);
                case 9:
                    return substr($codigo, 0, 1) . '.' . substr($codigo, 1, 1) .
                        '.' . substr($codigo, 2, 1) . '.' . substr($codigo, 3, 1) .
                            '.' . substr($codigo, 4, 2) . '.' . substr($codigo, 6, 3);
                case 10:
                    return substr($codigo, 0, 1) . '.' . substr($codigo, 1, 1) .
                        '.' . substr($codigo, 2, 1) . '.' . substr($codigo, 3, 1) .
                            '.' . substr($codigo, 4, 2) . '.' . substr($codigo, 6, 4);
                default:
                    return $codigo;
            }
        }
        
        return $codigo;
    }
    
    public function getCodigoPai($codigo)
    {
        switch (strlen($codigo))
        {
            case 1:
                return null;
            case 2:
                return substr($codigo, 0, 1);
            case 3:
                return substr($codigo, 0, 2);
            case 4:
                return substr($codigo, 0, 3);
            case 6:
                return substr($codigo, 0, 4);
            case 7:
            case 8:
            case 9:
            case 10:
                return substr($codigo, 0, 6);
            default:
                return null;
        }
    }
}
