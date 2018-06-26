<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;

class IndicadorForm extends Model
{
    public $ano;
    
    public $meses = [];
    
    public $empresa_id;
    
    public function rules()
    {
        return 
        [
            [['ano', 'meses', 'empresa_id'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }
}
