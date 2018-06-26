
<?php

use kartik\form\ActiveForm;
use kartik\builder\Form;
use kartik\helpers\Html;
use kartik\money\MaskMoney;

?>

<div class="row" style="padding: 10px;">

    <?php $form = ActiveForm::begin([
        'type' => ActiveForm::TYPE_VERTICAL,
    ]); ?>
    
    <?= Form::widget(
    [
        'model' => $model,
        'form' => $form,
        'columns' => 12,
        'attributes' =>
        [
            'nome' => 
            [
                'type' => Form::INPUT_TEXT,
                'columnOptions' => ['colspan' => 6]
            ],
            'faturamento_inicial' => 
            [
                'type' => Form::INPUT_WIDGET,
                'widgetClass' => MaskMoney::className(),
                'columnOptions' => ['colspan' => 3],
            ],
            'faturamento_final' => 
            [
                'type' => Form::INPUT_WIDGET,
                'widgetClass' => MaskMoney::className(),
                'columnOptions' => ['colspan' => 3],
            ]
        ],
    ]); ?>
    
    <?= Html::a('Voltar', ['index'], 
    [
        'class' => 'btn btn-default pull-right',
        'style' => 'margin-left: 5px;'
    ]); ?>

    <?= Html::submitButton('Salvar', 
    [
        'class' => 'btn btn-success pull-right',
    ]); ?>

    <?php ActiveForm::end(); ?>

</div>