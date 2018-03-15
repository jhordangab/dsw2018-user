<?php

namespace app\models\searches;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LogImportacao;

class LogImportacaoSearch extends LogImportacao
{
    public function rules()
    {
        return [
            [['id', 'mes', 'ano'], 'integer'],
            [['log', 'tipo', 'dt_log', 'usuario', 'empresa_nome'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = LogImportacao::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' =>
            [
                'pageSize' => 50
            ],
            'sort' =>
            [
                'defaultOrder' =>
                [
                    'dt_log' => SORT_DESC
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) 
        {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'dt_log' => $this->dt_log,
            'mes' => $this->mes,
            'ano' => $this->ano
        ]);

        $query->andFilterWhere(['like', 'log', $this->log])
            ->andFilterWhere(['like', 'usuario', $this->usuario])
            ->andFilterWhere(['like', 'empresa_nome', $this->empresa_nome])
            ->andFilterWhere(['like', 'tipo', $this->tipo]);

        return $dataProvider;
    }
}
