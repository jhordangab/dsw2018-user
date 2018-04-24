<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "indicador14".
 *
 * @property int $id
 * @property string $valor0
 * @property string $valor1
 * @property string $valor2
 * @property string $valor3
 * @property string $valor4
 * @property string $valor5
 * @property string $valor6
 * @property string $valor7
 * @property string $valor8
 * @property string $valor9
 * @property string $valor10
 * @property string $valor11
 * @property string $valor12
 * @property string $valor13
 * @property string $valor14
 * @property string $valor15
 * @property string $valor16
 * @property string $valor17
 * @property string $valor18
 * @property string $valor19
 * @property string $valor20
 * @property string $valor21
 * @property string $valor22
 * @property string $valor23
 * @property string $valor24
 * @property string $valor25
 * @property string $valor26
 * @property string $valor27
 */
class Indicador14 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'indicador14';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['valor0', 'valor1', 'valor2', 'valor3', 'valor4', 'valor5', 'valor6', 'valor7', 'valor8', 'valor9', 'valor10', 'valor11', 'valor12', 'valor13', 'valor14', 'valor15', 'valor16', 'valor17', 'valor18', 'valor19', 'valor20', 'valor21', 'valor22', 'valor23', 'valor24', 'valor25', 'valor26', 'valor27'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
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
            'valor18' => 'Valor18',
            'valor19' => 'Valor19',
            'valor20' => 'Valor20',
            'valor21' => 'Valor21',
            'valor22' => 'Valor22',
            'valor23' => 'Valor23',
            'valor24' => 'Valor24',
            'valor25' => 'Valor25',
            'valor26' => 'Valor26',
            'valor27' => 'Valor27',
        ];
    }
}
