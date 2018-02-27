<?php

namespace app\models;

use Yii;

class Empresa extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'empresa';
    }

    public function rules()
    {
        return [
            [['codigo', 'razao_social', 'cnpj'], 'required'],
            [['codigo', 'is_ativo', 'is_excluido', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['razao_social', 'cnpj'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return 
        [
            'codigo' => 'Código',
            'razao_social' => 'Razão Social',
            'cnpj' => 'CNPJ',
            'is_ativo' => 'Ativo'
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

    public function getCategoriaEmpresas()
    {
        return $this->hasMany(CategoriaEmpresa::className(), ['empresa_id' => 'id']);
    }
}
