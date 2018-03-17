
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
    
    <?= Form::widget(
    [
        'model' => $model,
        'form' => $form,
        'columns' => 12,
        'attributes' =>
        [
            'categoria_nome' => 
            [
                'type' => Form::INPUT_HIDDEN_STATIC,
                'columnOptions' => ['colspan' => 6],
            ],
            'valor' => 
            [
                'type' => Form::INPUT_WIDGET,
                'widgetClass' => MaskMoney::className(),
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
    