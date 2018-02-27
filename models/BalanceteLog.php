<?php

namespace app\models;

use Yii;

class BalanceteLog extends \yii\db\ActiveRecord
{
    public $updated_at;
    
    public static function tableName()
    {
        return 'balancete_log';
    }

    public function rules()
    {
        return [
            [['balancete_id', 'categoria_id', 'valor', 'log'], 'required'],
            [['balancete_id'], 'integer'],
            [['log'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['categoria_id', 'valor'], 'string', 'max' => 255],
            [['balancete_id'], 'exist', 'skipOnError' => true, 'targetClass' => Balancete::className(), 'targetAttribute' => ['balancete_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return 
        [
            'balancete_id' => 'Balancete ID',
            'categoria_id' => 'Categoria',
            'valor' => 'Valor',
            'log' => 'Log',
            'created_at' => 'Dt. de Importação',
        ];
    }
    
    public function behaviors()
    {
        return 
        [
            [
                'class' => \yii\behaviors\TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new \yii\db\Expression('NOW()'),
            ],
        ];
    }
    
    public function getBalancete()
    {
        return $this->hasOne(Balancete::className(), ['id' => 'balancete_id']);
    }

    public static function find()
    {
        return new \app\models\queries\BalanceteLogQuery(get_called_class());
    }
}
