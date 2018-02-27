<?php

namespace app\models;

use Yii;

class Balancete extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'balancete';
    }

    public function rules()
    {
        return [
            [['empresa_id', 'mes', 'ano'], 'required'],
            [['empresa_id', 'mes', 'ano', 'is_ativo', 'is_excluido', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['empresa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['empresa_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return 
        [
            'empresa_id' => 'Empresa',
            'mes' => 'Mês',
            'ano' => 'Ano',
            'is_ativo' => 'Ativo',
            'is_excluido' => 'Excluído',
            'created_at' => 'Dt. de Importação'
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

    public function getEmpresa()
    {
        return $this->hasOne(Empresa::className(), ['id' => 'empresa_id']);
    }

    public function getLogs()
    {
        return $this->hasMany(BalanceteLog::className(), ['balancete_id' => 'id']);
    }

    public function getValores()
    {
        return $this->hasMany(BalanceteValor::className(), ['balancete_id' => 'id']);
    }

    public static function find()
    {
        return new \app\models\queries\BalanceteQuery(get_called_class());
    }
}
