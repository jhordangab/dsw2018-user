<?php

use \kartik\form\ActiveForm,
    kartik\builder\Form,
    kartik\builder\FormGrid;
use kartik\file\FileInput;
use kartik\helpers\Html;

$this->registerCss("     
    .log-error
    {
        color: red;
        font-weight: 100;
        font-size: 12px;
    }
    
    .log-success
    {
        color: green;
        font-weight: 100;
        font-size: 12px;
    }

");

$js = <<<JS
     
    $('#form-importar-balancete').on('beforeSubmit', function (e) 
    {
        $('.div-loading').addClass("loading");
        return true;
    });
        
JS;

$this->registerJs($js);

$meses = 
[
    1 => 'Janeiro',
    2 => 'Fevereiro',
    3 => 'Março',
    4 => 'Abril',
    5 => 'Maio',
    6 => 'Junho',
    7 => 'Julho',
    8 => 'Agosto',
    9 => 'Setembro',
    10 => 'Outubro',
    11 => 'Novembro',
    12 => 'Dezembro'
];

$anos = [];

for($i = 2017; $i < 2022; $i++)
{
    $anos["$i"] = "{$i}";
}

?>

<div class="col-lg-12">

    <?php $form = ActiveForm::begin([
        'id' => 'form-importar-balancete',
        'type' => ActiveForm::TYPE_VERTICAL,
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?=
        FormGrid::widget(
        [
            'model' => $model,
            'form' => $form,
            'columnSize' => Form::SIZE_TINY,
            'autoGenerateColumns' => true,
            'rows' => 
            [
                [
                    'attributes' => 
                    [
                        'mes' => 
                        [
                            'label' => 'Mês',
                            'type' => Form::INPUT_DROPDOWN_LIST,
                            'items' => $meses,
                            'options' => 
                            [
                                'prompt' => ''
                            ]
                        ],
                        'ano' => 
                        [
                            'label' => 'Ano',
                            'type' => Form::INPUT_DROPDOWN_LIST,
                            'items' => $anos,
                            'options' => 
                            [
                                'prompt' => ''
                            ]
                        ],
                    ]
                ]
            ]
        ]);
    ?>

    <?=
        FormGrid::widget(
        [
            'model' => $model,
            'form' => $form,
            'columnSize' => Form::SIZE_TINY,
            'autoGenerateColumns' => true,
            'rows' => 
            [
                [
                    'attributes' => 
                    [
                        'file' => 
                        [
                            'label' => 'Arquivo',
                            'type' => Form::INPUT_WIDGET,
                            'widgetClass' => FileInput::classname(),
                            'columnOptions' => ['class' => 'col-xs-3'],
                            'options' => 
                            [
                                'pluginOptions' => 
                                [
                                    'browseLabel' => 'Buscar',
                                    'browseClass' => 'btn btn-success',
                                    'removeLabel' => 'Remover',
                                    'showUpload' => FALSE,
                                    'language' => 'pt-BR',
                                    'allowedFileExtensions' => ['xls', 'xlsx', 'ods'],
                                ]
                            ]
                        ],
                    ]
                ]
            ]
        ]);
    ?>
    
    <?=
        FormGrid::widget(
        [
            'model' => $model,
            'form' => $form,
            'columnSize' => Form::SIZE_TINY,
            'autoGenerateColumns' => true,
            'rows' => 
            [
                [
                    'attributes' => 
                    [
                        'importar_saldo' => 
                        [
                            'label' => 'Importar saldo inicial?',
                            'type' => Form::INPUT_CHECKBOX,
                        ]
                    ]
                ]
            ]
        ]);
    ?>

    <?= Html::submitButton('Importar', 
    [
        'class' => 'btn btn-success pull-right',
    ]); ?>

    <?php ActiveForm::end(); ?>

</div>
    