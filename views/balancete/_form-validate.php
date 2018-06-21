
<?php

use kartik\form\ActiveForm;
use kartik\builder\Form;
use kartik\helpers\Html;
use kartik\money\MaskMoney;

?>

<div class="col-lg-12">

    <?php $form = ActiveForm::begin([
        'type' => ActiveForm::TYPE_VERTICAL,
    ]); ?>
    
    <legend>LALUR</legend>
    
    <?= Form::widget(
    [
        'model' => $model,
        'form' => $form,
        'columns' => 2,
        'attributes' =>
        [
            'outras_adicoes' => 
            [
                'type' => Form::INPUT_WIDGET,
                'widgetClass' => MaskMoney::className(),
                'columnOptions' => ['colspan' => 1],
            ],
            'outras_exclusoes' => 
            [
                'type' => Form::INPUT_WIDGET,
                'widgetClass' => MaskMoney::className(),
                'columnOptions' => ['colspan' => 1],
            ]
        ],
    ]); ?>
    
    <?= Form::widget(
    [
        'model' => $model,
        'form' => $form,
        'columns' => 2,
        'attributes' =>
        [
            'base_negativa' => 
            [
                'type' => Form::INPUT_WIDGET,
                'widgetClass' => MaskMoney::className(),
                'columnOptions' => ['colspan' => 1],
            ],
            'csll_retida' => 
            [
                'type' => Form::INPUT_WIDGET,
                'widgetClass' => MaskMoney::className(),
                'columnOptions' => ['colspan' => 1],
            ]
        ],
    ]); ?>
    
    <?= Form::widget(
    [
        'model' => $model,
        'form' => $form,
        'columns' => 3,
        'attributes' =>
        [
            'prejuizo_anterior_compensar' => 
            [
                'type' => Form::INPUT_WIDGET,
                'widgetClass' => MaskMoney::className(),
                'columnOptions' => ['colspan' => 1],
            ],
            'base_negativa_irpj' => 
            [
                'type' => Form::INPUT_WIDGET,
                'widgetClass' => MaskMoney::className(),
                'columnOptions' => ['colspan' => 1],
            ],
            'irrf_mes' => 
            [
                'type' => Form::INPUT_WIDGET,
                'widgetClass' => MaskMoney::className(),
                'columnOptions' => ['colspan' => 1],
            ],
        ],
    ]); ?>

    <?= Html::submitButton('Salvar', 
    [
        'class' => 'btn btn-success pull-right',
    ]); ?>

    <?php ActiveForm::end(); ?>

</div>
    