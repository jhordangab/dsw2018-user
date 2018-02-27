<?php

namespace app\models;

use Yii;

class CategoriaEmpresa extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'categoria_empresa';
    }

    public function rules()
    {
        return [
            [['empresa_id', 'codigo', 'desc_codigo', 'descricao'], 'required'],
            [['empresa_id', 'codigo_pai', 'codigo', 'is_service', 'is_ativo', 'is_excluido', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['codigo_red', 'desc_codigo', 'descricao'], 'string', 'max' => 255],
            [['empresa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['empresa_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return 
        [
            'empresa_id' => 'Empresa',
            'codigo_pai' => 'Categoria Pai',
            'codigo' => 'Código',
            'codigo_red' => 'Código Red',
            'desc_codigo' => 'Descrição do Código',
            'descricao' => 'Código',
            'is_service' => 'Serviço',
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

    public function getEmpresa()
    {
        return $this->hasOne(Empresa::className(), ['id' => 'empresa_id']);
    }

    public static function find()
    {
        return new \app\models\queries\CategoriaEmpresaQuery(get_called_class());
    }
}
