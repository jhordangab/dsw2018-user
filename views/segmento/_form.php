
<?php

use kartik\form\ActiveForm;
use kartik\builder\Form;
use kartik\helpers\Html;

?>

<div class="row" style="padding: 10px;">

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
            'nome' => 
            [
                'type' => Form::INPUT_TEXT
            ],
            'referencia' => 
            [
                'type' => Form::INPUT_TEXT
            ],
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
    