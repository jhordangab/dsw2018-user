<?php

namespace app\models\searches;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Balancete;

class BalanceteSearch extends Balancete
{
    public function rules()
    {
        return [
            [['id', 'empresa_id', 'mes', 'ano', 'is_ativo', 'is_excluido', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at', 'empresa_nome', 'status'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Balancete::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' =>
            [
                'defaultOrder' =>
                [
                    'ano' => SORT_DESC,
                    'mes' => SORT_DESC
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) 
        {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'empresa_id' => $this->empresa_id,
            'mes' => $this->mes,
            'ano' => $this->ano,
            'is_ativo' => $this->is_ativo,
            'is_excluido' => FALSE,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);
        
        $query->andFilterWhere(['like', 'status', $this->status])
        ->andFilterWhere(['like', 'empresa_nome', $this->empresa_nome]);

        return $dataProvider;
    }
}
