<?php

namespace app\models;

use Yii;

class Bandeira extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'bandeira';
    }

    public function rules()
    {
        return [
            [['nome', 'referencia'], 'required'],
            [['created_at', 'updated_at', 'is_ativo', 'is_excluido'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
            [['nome', 'referencia'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return 
        [
            'nome' => 'Nome',
            'referencia' => 'Referência',
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
    
    public function getEmpresas()
    {
        return $this->hasMany(EmpresaDado::className(), ['bandeira_id' => 'id']);
    }
}
