<?php

namespace app\models;

use Yii;

class Indicador extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'ind_indicador';
    }

    public function rules()
    {
        return [
            [['desc_indicador', 'admcone_id'], 'required'],
            [['admcone_id', 'numr_ordem', 'numr_tempo'], 'integer'],
            [['desc_sintetico', 'desc_analitico'], 'string'],
            [['dthr_atualizacao'], 'safe'],
            [['desc_indicador'], 'string', 'max' => 60],
            [['indr_tipo_grafico', 'indr_status', 'indr_direcao', 'indr_periodicidade', 'indr_3d'], 'string', 'max' => 1],
            [['desc_descricao'], 'string', 'max' => 6000],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'desc_indicador' => 'Desc Indicador',
            'admcone_id' => 'Admcone ID',
            'indr_tipo_grafico' => 'Indr Tipo Grafico',
            'desc_sintetico' => 'Desc Sintetico',
            'desc_analitico' => 'Desc Analitico',
            'indr_status' => 'Indr Status',
            'indr_direcao' => 'Indr Direcao',
            'indr_periodicidade' => 'Indr Periodicidade',
            'indr_3d' => 'Indr 3d',
            'numr_ordem' => 'Numr Ordem',
            'numr_tempo' => 'Numr Tempo',
            'desc_descricao' => 'Desc Descricao',
            'dthr_atualizacao' => 'Dthr Atualizacao',
        ];
    }
}
