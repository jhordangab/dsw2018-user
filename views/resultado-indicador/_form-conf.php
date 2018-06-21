
<?php

use kartik\form\ActiveForm;
use kartik\builder\Form;
use kartik\helpers\Html;

?>

<div class="col-lg-12">

    <?php $form = ActiveForm::begin([
        'type' => ActiveForm::TYPE_VERTICAL,
    ]); ?>
    
    <?= Form::widget(
    [
        'model' => $model,
        'form' => $form,
        'columns' => 2,
        'attributes' =>
        [
            'valuation_metodo_ebitda' => 
            [
                'type' => Form::INPUT_TEXT,
                'options' =>
                [
                    'type' => 'number'
                ],
                'columnOptions' => ['colspan' => 1],
            ],
            'custo_capital_proprio' => 
            [
                'label' => 'Custo capital próprio (%)',
                'type' => Form::INPUT_TEXT,
                'options' =>
                [
                    'type' => 'number'
                ],
                'columnOptions' => ['colspan' => 1],
            ]
        ],
    ]); ?>

    <?= Html::submitButton('Salvar', 
    [
        'class' => 'btn btn-success pull-right',
    ]); ?>

    <?php ActiveForm::end(); ?>

</div>
    