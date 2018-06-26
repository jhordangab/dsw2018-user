<?php

namespace app\models\searches;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EstadoRegiao;

class EstadoRegiaoSearch extends EstadoRegiao
{
    public function rules()
    {
        return [
            [['id', 'created_by', 'updated_by'], 'integer'],
            [['uf', 'nome_estado', 'regiao', 'sigla_regiao', 'tipo_regiao', 'is_ativo', 'is_excluido', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = EstadoRegiao::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' =>
            [
                'defaultOrder' =>
                [
                    'nome_estado' => SORT_ASC,
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) 
        {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'is_ativo' => $this->is_ativo,
            'is_excluido' => FALSE
        ]);

        $query->andFilterWhere(['like', 'uf', $this->uf])
            ->andFilterWhere(['like', 'nome_estado', $this->nome_estado])
            ->andFilterWhere(['like', 'regiao', $this->regiao])
            ->andFilterWhere(['like', 'sigla_regiao', $this->sigla_regiao])
            ->andFilterWhere(['like', 'tipo_regiao', $this->tipo_regiao]);

        return $dataProvider;
    }
}
