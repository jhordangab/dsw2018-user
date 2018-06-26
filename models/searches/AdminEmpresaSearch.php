<?php

namespace app\models\searches;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AdminEmpresa;

class AdminEmpresaSearch extends AdminEmpresa
{
    public $regiao;
    
    public $unidade;
    
    public $faixa_faturamento;
    
    public $bandeira;
    
    public $segmento;
    
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['nomeResumo', 'razaoSocial', 'status', 'regiao', 'unidade', 'faixa_faturamento', 'bandeira', 'segmento'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = AdminEmpresa::find()->joinWith(['dado', 'dado.regiao', 'dado.faixaFaturamento', 'dado.bandeira', 'dado.segmento']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' =>
            [
                'defaultOrder' =>
                [
                    'nomeResumo' => SORT_ASC,
                ]
            ]
        ]);
        
        $dataProvider->sort->attributes['regiao'] = 
        [
            'asc' => ['estado_regiao.nome_estado' => SORT_ASC],
            'desc' => ['estado_regiao.nome_estado' => SORT_DESC],
        ];
        
        $dataProvider->sort->attributes['unidade'] = 
        [
            'asc' => ['empresa_dado.unidade' => SORT_ASC],
            'desc' => ['empresa_dado.unidade' => SORT_DESC],
        ];
        
        $dataProvider->sort->attributes['faixa_faturamento'] = 
        [
            'asc' => ['faixa_faturamento.nome' => SORT_ASC],
            'desc' => ['faixa_faturamento.nome' => SORT_DESC],
        ];
        
        $dataProvider->sort->attributes['bandeira'] = 
        [
            'asc' => ['bandeira.nome' => SORT_ASC],
            'desc' => ['bandeira.nome' => SORT_DESC],
        ];
        
        $dataProvider->sort->attributes['segmento'] = 
        [
            'asc' => ['segmento.nome' => SORT_ASC],
            'desc' => ['segmento.nome' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) 
        {
            return $dataProvider;
        }

        $query->andWhere('admin_empresa.id not in (1, 2)');

        $query->andFilterWhere(['like', 'admin_empresa.nomeResumo', $this->nomeResumo])
            ->andFilterWhere(['like', 'admin_empresa.razaoSocial', $this->razaoSocial])
            ->andFilterWhere(['like', 'estado_regiao.nome_estado', $this->regiao])
            ->andFilterWhere(['like', 'empresa_dado.unidade', $this->unidade])
            ->andFilterWhere(['like', 'faixa_faturamento.nome', $this->faixa_faturamento])
            ->andFilterWhere(['like', 'bandeira.nome', $this->bandeira])
            ->andFilterWhere(['like', 'segmento.nome', $this->segmento])
            ->andFilterWhere(['like', 'admin_empresa.status', 'Ativo']);

        return $dataProvider;
    }
}
