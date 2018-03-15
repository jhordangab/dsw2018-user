<?php

namespace app\models;

use Yii;

class LogImportacao extends \yii\db\ActiveRecord
{
    public $updated_at;
    
    public static function tableName()
    {
        return 'log_importacao';
    }

    public function rules()
    {
        return [
            [['log', 'tipo', 'usuario', 'empresa_nome', 'mes', 'ano'], 'required'],
            [['dt_log', 'updated_at'], 'safe'],
            [['log', 'usuario', 'empresa_nome'], 'string', 'max' => 255],
            [['tipo'], 'string', 'max' => 1],
        ];
    }

    public function behaviors()
    {
        return 
        [
            [
                'class' => \yii\behaviors\TimestampBehavior::className(),
                'createdAtAttribute' => 'dt_log',
                'updatedAtAttribute' => 'updated_at',
                'value' => new \yii\db\Expression('NOW()'),
            ],
        ];
    }
    
    public function attributeLabels()
    {
        return 
        [
            'log' => 'Log',
            'tipo' => 'Tipo',
            'usuario' => 'Usuário',
            'dt_log' => 'Data',
            'empresa_nome' => 'Empresa',
            'mes' => 'Mês',
            'ano' => 'Ano'
        ];
    }
}
