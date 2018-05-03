<?php

namespace app\models;

use Yii;

class Indicador16 extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'indicador16';
    }

    public function rules()
    {
        return [
            [['valor0', 'valor1', 'valor2', 'valor3', 'valor4', 'valor5', 'valor6', 'valor7', 'valor8', 'valor9', 'valor10', 'valor11', 'valor12', 'valor13', 'valor14', 'valor15', 'valor16', 'valor17'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'valor0' => 'Valor0',
            'valor1' => 'Valor1',
            'valor2' => 'Valor2',
            'valor3' => 'Valor3',
            'valor4' => 'Valor4',
            'valor5' => 'Valor5',
            'valor6' => 'Valor6',
            'valor7' => 'Valor7',
            'valor8' => 'Valor8',
            'valor9' => 'Valor9',
            'valor10' => 'Valor10',
            'valor11' => 'Valor11',
            'valor12' => 'Valor12',
            'valor13' => 'Valor13',
            'valor14' => 'Valor14',
            'valor15' => 'Valor15',
            'valor16' => 'Valor16',
            'valor17' => 'Valor17',
        ];
    }
}
