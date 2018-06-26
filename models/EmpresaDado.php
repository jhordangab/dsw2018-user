<?php

namespace app\models;

use Yii;

class EmpresaDado extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'empresa_dado';
    }

    public function rules()
    {
        return [
            [['empresa_id', 'regiao_id', 'faixa_faturamento_id', 'bandeira_id', 'segmento_id', 'unidade'], 'required'],
            [['empresa_id', 'regiao_id', 'faixa_faturamento_id', 'bandeira_id', 'segmento_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at', 'is_ativo', 'is_excluido'], 'safe'],
            [['unidade'], 'string', 'max' => 255],
            [['bandeira_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bandeira::className(), 'targetAttribute' => ['bandeira_id' => 'id']],
            [['empresa_id'], 'exist', 'skipOnError' => true, 'targetClass' => AdminEmpresa::className(), 'targetAttribute' => ['empresa_id' => 'id']],
            [['faixa_faturamento_id'], 'exist', 'skipOnError' => true, 'targetClass' => FaixaFaturamento::className(), 'targetAttribute' => ['faixa_faturamento_id' => 'id']],
            [['regiao_id'], 'exist', 'skipOnError' => true, 'targetClass' => EstadoRegiao::className(), 'targetAttribute' => ['regiao_id' => 'id']],
            [['segmento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Segmento::className(), 'targetAttribute' => ['segmento_id' => 'id']],
        ];
    }
    
    public function attributeLabels()
    {
        return 
        [
            'empresa_id' => 'Empresa',
            'regiao_id' => 'Região',
            'faixa_faturamento_id' => 'Faixa de Faturamento',
            'bandeira_id' => 'Bandeira',
            'segmento_id' => 'Segmento',
            'unidade' => 'Unidade',
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
    
    public function getBandeira()
    {
        return $this->hasOne(Bandeira::className(), ['id' => 'bandeira_id']);
    }

    public function getEmpresa()
    {
        return $this->hasOne(AdminEmpresa::className(), ['id' => 'empresa_id']);
    }

    public function getFaixaFaturamento()
    {
        return $this->hasOne(FaixaFaturamento::className(), ['id' => 'faixa_faturamento_id']);
    }

    public function getRegiao()
    {
        return $this->hasOne(EstadoRegiao::className(), ['id' => 'regiao_id']);
    }

    public function getSegmento()
    {
        return $this->hasOne(Segmento::className(), ['id' => 'segmento_id']);
    }
}
