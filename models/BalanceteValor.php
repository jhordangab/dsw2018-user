<?php

namespace app\models;

use Yii;

class BalanceteValor extends \yii\db\ActiveRecord
{
    public $categoria_nome;
    
    public static function tableName()
    {
        return 'balancete_valor';
    }

    public function rules()
    {
        return [
            [['balancete_id', 'categoria_id', 'valor'], 'required'],
            [['balancete_id', 'categoria_id', 'is_ativo', 'is_excluido', 'created_by', 'updated_by'], 'integer'],
            [['valor'], 'number'],
            [['created_at', 'updated_at', 'categoria_nome'], 'safe'],
            [['balancete_id'], 'exist', 'skipOnError' => true, 'targetClass' => Balancete::className(), 'targetAttribute' => ['balancete_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return 
        [
            'balancete_id' => 'Balancete',
            'categoria_id' => 'Categoria',
            'valor' => 'Valor',
            'created_at' => 'Dt. de Importação',
            'categoria_nome' => 'Categoria'
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

    public function getBalancete()
    {
        return $this->hasOne(Balancete::className(), ['id' => 'balancete_id']);
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
                'empresa_id' => $this->balancete->empresa_id,
                'codigo' => $this->categoria_id
            ])->one();
        }
        
        return $categoria;
    }

    public static function find()
    {
        return new \app\models\queries\BalanceteValorQuery(get_called_class());
    }
}
