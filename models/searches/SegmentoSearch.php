<?php

namespace app\models\searches;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Segmento;

class SegmentoSearch extends Segmento
{
    public function rules()
    {
        return [
            [['id', 'created_by', 'updated_by'], 'integer'],
            [['nome', 'referencia', 'is_ativo', 'is_excluido', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Segmento::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' =>
            [
                'defaultOrder' =>
                [
                    'nome' => SORT_ASC,
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
            'is_excluido' => FALSE,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'referencia', $this->referencia]);

        return $dataProvider;
    }
}
