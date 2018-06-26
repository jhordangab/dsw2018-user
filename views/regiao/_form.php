
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
        'columns' => 12,
        'attributes' =>
        [
            'uf' => 
            [
                'type' => Form::INPUT_TEXT,
                'columnOptions' => ['colspan' => 1]
            ],
            'nome_estado' => 
            [
                'type' => Form::INPUT_TEXT,
                'columnOptions' => ['colspan' => 3]
            ],
            'sigla_regiao' => 
            [
                'type' => Form::INPUT_TEXT,
                'columnOptions' => ['colspan' => 1]
            ],
            'regiao' => 
            [
                'type' => Form::INPUT_TEXT,
                'columnOptions' => ['colspan' => 3]
            ],
            'tipo_regiao' => 
            [
                'type' => Form::INPUT_TEXT,
                'columnOptions' => ['colspan' => 4]
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