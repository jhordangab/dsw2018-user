<?php

namespace app\models;

use Yii;

class ResultadoIndicador extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'resultado_indicador';
    }

    public function rules()
    {
        return [
            [['empresa_id', 'ano', 'valuation_metodo_ebitda', 'custo_capital_proprio'], 'required'],
            [['empresa_id', 'ano', 'valuation_metodo_ebitda', 'custo_capital_proprio', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at', 'is_ativo', 'is_excluido'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return 
        [
            'empresa_id' => 'Empresa',
            'ano' => 'Ano',
            'valuation_metodo_ebitda' => 'Valuation Método EBITDA',
            'custo_capital_proprio' => 'Custo capital próprio',
            'is_ativo' => 'Ativo',
            'is_excluido' => 'Excluído',
            'created_at' => 'Dt. de Cadastro',
            'updated_at' => 'Dt. de Alteração',
            'created_by' => 'Usuário de Cadastro',
            'updated_by' => 'Usuário de Alteração',
        ];
    }
    
    public function behaviors()
    {
        return 
        [
            [
                'class' => \yii\behaviors\BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            [
                'class' => \yii\behaviors\TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new \yii\db\Expression('NOW()'),
            ],
        ];
    }
    
    public static function find()
    {
        return new \app\models\queries\ResultadoIndicadorQuery(get_called_class());
    }
}
