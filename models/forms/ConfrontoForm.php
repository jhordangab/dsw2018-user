<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;

class ConfrontoForm extends Model
{
    public $empresa_id;
    
    public $ano_x;
    
    public $ano_y;
    
    public $meses_x = [];
    
    public $meses_y = [];
    
    public function rules()
    {
        return 
        [
            [['empresa_id', 'ano_x', 'ano_y', 'meses_x', 'meses_y'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }
}
