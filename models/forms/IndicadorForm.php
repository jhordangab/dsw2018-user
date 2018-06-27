<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;

class IndicadorForm extends Model
{
    public $ano;
    
    public $empresa_id;
    
    public function rules()
    {
        return 
        [
            [['ano', 'empresa_id'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }
}
