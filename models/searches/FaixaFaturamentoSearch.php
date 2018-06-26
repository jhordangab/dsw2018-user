<?php

namespace app\models\searches;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FaixaFaturamento;

class FaixaFaturamentoSearch extends FaixaFaturamento
{
    public function rules()
    {
        return [
            [['id', 'created_by', 'updated_by'], 'integer'],
            [['nome', 'is_ativo', 'is_excluido', 'created_at', 'updated_at'], 'safe'],
            [['faturamento_inicial', 'faturamento_final'], 'number'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = FaixaFaturamento::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' =>
            [
                'defaultOrder' =>
                [
                    'faturamento_inicial' => SORT_ASC,
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) 
        {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'faturamento_inicial' => $this->faturamento_inicial,
            'faturamento_final' => $this->faturamento_final,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'is_ativo' => $this->is_ativo,
            'is_excluido' => FALSE
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome]);

        return $dataProvider;
    }
}
