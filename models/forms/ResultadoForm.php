<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;

class ResultadoForm extends Model
{
    CONST RESULTADO_BALANCETE = 'balancete';
    
    CONST RESULTADO_CMV = 'cmv';
    
    CONST RESULTADO_DESPESA = 'despesa';
    
    CONST RESULTADO_DFC = 'dfc';
    
    CONST RESULTADO_DRE = 'dre';
    
    CONST RESULTADO_LALUR = 'lalur';
    
    CONST RESULTADO_OUTRAS_DESPESAS = 'outras_rd';
    
    CONST RESULTADO_RF = 'rf';
    
    public static $resultados = 
    [
        self::RESULTADO_BALANCETE => 'Balancete',
        self::RESULTADO_CMV => 'CMV',
        self::RESULTADO_DESPESA => 'Despesas',
        self::RESULTADO_DFC => 'DFC',
        self::RESULTADO_DRE => 'DRE',
        self::RESULTADO_LALUR => 'LALUR',
        self::RESULTADO_OUTRAS_DESPESAS => 'Outras Receitas/Despesas',
        self::RESULTADO_RF => 'RF '
    ];
    
    public $ano;
    
    public $meses = [];
    
    public $empresa_id;
    
    public $tipo;
    
    public function rules()
    {
        return 
        [
            [['ano', 'meses', 'empresa_id', 'tipo'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }
}
