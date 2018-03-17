<?php

namespace app\models;

use Yii;

class SaldoInicial extends \yii\db\ActiveRecord
{
    public $categoria_nome;
    
    public static function tableName()
    {
        return 'saldo_inicial';
    }

    public function rules()
    {
        return 
        [
            [['empresa_id', 'empresa_nome', 'mes', 'ano', 'categoria_id', 'valor'], 'required'],
            [['empresa_id', 'mes', 'ano', 'categoria_id', 'is_ativo', 'is_excluido', 'created_by', 'updated_by'], 'integer'],
            [['valor'], 'number'],
            [['created_at', 'updated_at', 'categoria_nome'], 'safe'],
            [['empresa_nome'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return
        [
            'empresa_id' => 'Empresa',
            'empresa_nome' => 'Empresa',
            'mes' => 'Mês',
            'ano' => 'Ano',
            'categoria_id' => 'Categoria',
            'categoria_nome' => 'Categoria',
            'valor' => 'Valor',
            'is_ativo' => 'Ativo',
            'is_excluido' => 'Excluído',
            'created_at' => 'Dt. de Importação',
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
    
    public function getCategoria()
    {
        $categoria = CategoriaPadrao::find()->andWhere(
        [
            'is_ativo' => TRUE,
            'is_excluido' => FALSE,
            'codigo' => $this->categoria_id
        ])->one();
        
        if(!$categoria)
        {
            $categoria = CategoriaEmpresa::find()->andWhere(
            [
                'is_ativo' => TRUE,
                'is_excluido' => FALSE,
                'empresa_id' => $this->empresa_id,
                'codigo' => $this->categoria_id
            ])->one();
        }
        
        return $categoria;
    }
}
