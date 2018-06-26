<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;

class ResultadoForm extends Model
{
    CONST RESULTADO_BALANCETE = 0;
    
    CONST RESULTADO_CMV = 1;
    
    CONST RESULTADO_DESPESA = 2;
    
    CONST RESULTADO_DFC = 3;
    
    CONST RESULTADO_DRE = 4;
    
    CONST RESULTADO_LALUR = 5;
    
    CONST RESULTADO_OUTRAS_DESPESAS = 6;
    
    CONST RESULTADO_RF = 7;
    
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
