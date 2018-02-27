<?php

namespace app\models;

use Yii;

class CategoriaPadrao extends \yii\db\ActiveRecord
{
    public $desc_categoria_pai;
    
    public static function tableName()
    {
        return 'categoria_padrao';
    }

    public function rules()
    {
        return [
            [['codigo_pai', 'codigo', 'is_service', 'is_ativo', 'is_excluido', 'created_by', 'updated_by'], 'integer'],
            [['codigo', 'desc_codigo', 'descricao'], 'required'],
            [['created_at', 'updated_at', 'desc_categoria_pai'], 'safe'],
            [['codigo_red', 'desc_codigo', 'descricao'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return 
        [
            'codigo_pai' => 'Categoria Pai',
            'codigo' => 'Código',
            'codigo_red' => 'Código Red',
            'desc_codigo' => 'Descrição do Código',
            'descricao' => 'Categoria',
            'is_service' => 'Serviço',
            'is_ativo' => 'Ativo',
            'is_excluido' => 'Excluído',
            'created_at' => 'Dt. de Cadastro',
            'updated_at' => 'Dt. de Alteração',
            'created_by' => 'Usuário de Cadastro',
            'updated_by' => 'Usuário de Alteração',
            'desc_categoria_pai' => 'Categoria Pai'
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
        return new \app\models\queries\CategoriaPadraoQuery(get_called_class());
    }
}
