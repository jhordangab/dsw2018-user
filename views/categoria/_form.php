
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
        'columns' => 1,
        'attributes' =>
        [
            'desc_categoria_pai' => 
            [
                'label' => '',
                'type' => Form::INPUT_HIDDEN_STATIC,
            ]
        ],
    ]); ?>

    <?= Form::widget(
    [
        'model' => $model,
        'form' => $form,
        'columns' => 12,
        'attributes' =>
        [
            'codigo' => 
            [
                'type' => Form::INPUT_TEXT,
                'options' =>
                [
                    'placeholder' => $categoria_pai->codigo . '...'
                ],
                'columnOptions' => ['colspan' => 3],
            ],
            'desc_codigo' => 
            [
                'type' => Form::INPUT_TEXT,
                'options' =>
                [
                    'placeholder' => $categoria_pai->desc_codigo . '...'
                ],
                'columnOptions' => ['colspan' => 3],
            ],
            'descricao' => 
            [
                'type' => Form::INPUT_TEXT,
                'columnOptions' => ['colspan' => 6],
            ]
        ],
    ]); ?>

    <?= Html::submitButton('Salvar', 
    [
        'class' => 'btn btn-success pull-right',
    ]); ?>

    <?php ActiveForm::end(); ?>

</div>
    