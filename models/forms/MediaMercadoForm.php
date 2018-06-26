<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;

class MediaMercadoForm extends Model
{
    public $ano;
    
    public $mes;
    
    public $empresa_id;
    
    public $regiao_id;
    
    public $faturamento_id;
    
    public $bandeira_id;
    
    public $segmento_id;
    
    public function rules()
    {
        return 
        [
            [['ano', 'mes', 'empresa_id', 'regiao_id', 'faturamento_id', 'bandeira_id', 'segmento_id'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }
}
