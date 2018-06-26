<?php

namespace app\models;

use Yii;

class EstadoRegiao extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'estado_regiao';
    }

    public function rules()
    {
        return [
            [['uf', 'nome_estado', 'regiao', 'sigla_regiao', 'tipo_regiao'], 'required'],
            [['created_at', 'updated_at', 'is_ativo', 'is_excluido'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
            [['uf', 'nome_estado', 'regiao', 'sigla_regiao', 'tipo_regiao'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return 
        [
            'uf' => 'UF',
            'nome_estado' => 'Estado',
            'regiao' => 'Região',
            'sigla_regiao' => 'Sigla',
            'tipo_regiao' => 'Tipo',
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
        return $this->hasMany(EmpresaDado::className(), ['regiao_id' => 'id']);
    }
}
