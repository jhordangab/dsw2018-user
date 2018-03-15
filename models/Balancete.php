<?php

namespace app\models;

use Yii;

class Balancete extends \yii\db\ActiveRecord
{
    const SCENARIO_IMPORTATION = 'importation';
    const SCENARIO_VALIDATION = 'validation';
  
    public static function tableName()
    {
        return 'balancete';
    }

    public function rules()
    {
        return 
        [
            [['empresa_id', 'mes', 'ano', 'status', 'empresa_nome'], 'required'],
            [['empresa_id', 'mes', 'ano', 'status', 'empresa_nome'], 'required', 'on' => self::SCENARIO_IMPORTATION],
            [['status', 'outras_adicoes', 'outras_exclusoes', 'base_negativa',
                'csll_retida', 'prejuizo_anterior_compensar', 'base_negativa_irpj', 'irrf_mes', 'valuation_metodo_ebitda', 'custo_capital_proprio'], 'safe', 'on' => self::SCENARIO_VALIDATION],
            [['empresa_id', 'mes', 'ano', 'is_ativo', 'is_excluido', 'created_by', 'updated_by', 'valuation_metodo_ebitda', 'custo_capital_proprio'], 'integer'],
            [['created_at', 'updated_at', 'outras_adicoes', 'outras_exclusoes', 'base_negativa',
                'csll_retida', 'prejuizo_anterior_compensar', 'base_negativa_irpj', 'irrf_mes', 'valuation_metodo_ebitda', 'custo_capital_proprio'], 'safe'],
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
            'is_ativo' => 'Ativo',
            'is_excluido' => 'Excluído',
            'created_at' => 'Dt. de Importação',
            'status' => 'Status',
            'outras_adicoes' => 'Outras Adições',
            'outras_exclusoes' => 'Outras Exclusões',
            'base_negativa' => 'Base Negativa da Contrib. Social (Lim.30%) ',
            'csll_retida' => 'CSLL retida no mês',
            'prejuizo_anterior_compensar' => 'Prejuízo anterior a compensar',
            'base_negativa_irpj' => 'Base Negativa do IRPJ (Lim.30%)',
            'irrf_mes' => 'IRRF no mês',
            'valuation_metodo_ebitda' => 'Valuation Método EBITDA',
            'custo_capital_proprio' => 'Custo capital próprio'
        ];
    }
    
    public function scenarios()
    {
        $scenarios = $this->getCustomScenarios();
        return $scenarios;
    }
    
    public function getCustomScenarios()
    {
 
        return
        [
            self::SCENARIO_IMPORTATION => 
            [
                'empresa_id', 'empresa_nome', 'mes', 'ano', 'status', 'is_ativo', 'is_excluido',
                'created_at', 'updated_by', 'created_at', 'updated_at'
            ],
            self::SCENARIO_VALIDATION =>  
            [
                'status', 'is_ativo', 'outras_adicoes', 'outras_exclusoes', 'base_negativa',
                'csll_retida', 'prejuizo_anterior_compensar', 'base_negativa_irpj', 'irrf_mes',
                'valuation_metodo_ebitda', 'custo_capital_proprio',
                'is_excluido', 'created_at', 'updated_by', 'created_at', 'updated_at'
            ],
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

    public function getValores()
    {
        return $this->hasMany(BalanceteValor::className(), ['balancete_id' => 'id']);
    }

    public static function find()
    {
        return new \app\models\queries\BalanceteQuery(get_called_class());
    }
}
