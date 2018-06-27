<?php

use kartik\form\ActiveForm;
use kartik\builder\Form;
use kartik\helpers\Html;
use yii\helpers\ArrayHelper;

$this->title = 'Confronto';
$this->params['breadcrumbs'][] = $this->title;

$js = <<<JS
        
    $('input[type="checkbox"]').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass   : 'iradio_flat-green'
    })
        
JS;

$this->registerJs($js);

$meses = 
[
    1 => 'Jan.',
    2 => 'Fev.',
    3 => 'Mar.',
    4 => 'Abr.',
    5 => 'Mai.',
    6 => 'Jun.',
    7 => 'Jul.',
    8 => 'Ago.',
    9 => 'Set.',
    10 => 'Out.',
    11 => 'Nov.',
    12 => 'Dez.'
];

$anos_x = $anos_y = [];
$ano_atual = (int) date('Y');

for($i = 2016; $i <= $ano_atual; $i++)
{
    if($i < $ano_atual)
    {
        $anos_x[$i] = "{$i}";
    }
    $anos_y[$i] = "{$i}";
}

$js = <<<JS
        
    $('#btn-confronto').click(function () 
    {
        _error = false;
        _message = "Os seguintes campos obrigatórios estão vazios: \\n\\n";
        
        if($('#confrontoform-empresa_id').val() == '')
        {
            _error = true;
            _message += " - Empresa \\n";
        }
        
        if($('#confrontoform-ano_x').val() == '')
        {
            _error = true;
            _message += " - Ano Principal \\n";
        }
        
        if($('#confrontoform-ano_y').val() == '')
        {
            _error = true;
            _message += " - Ano de Confronto \\n";
        }
        
        if(_error)
        {
            swal({
                title: "Erro",
                text: _message,
                icon: "error",
                dangerMode: true,
            });
        }
        else
        {
            jQuery.ajax({
                url: '/confronto/get-data',
                data: $('#form-confronto').serialize(),
                type: 'POST',
                success: function (data) 
                {
                    $('#render-result').html(data);
                },
            });
        }
    });
            
    $(document).on(
    {
        ajaxStart: function() { $('.div-loading').addClass("loading");},
        ajaxStop: function() { setTimeout(function() { $('.div-loading').removeClass("loading");}, 300);}    
    });
        
JS;

$this->registerJs($js);

?>

<div class="row">

    <div class="col-lg-12">
        
        <?php $form = ActiveForm::begin([
            'id' => 'form-confronto',
            'type' => ActiveForm::TYPE_VERTICAL,
        ]); ?>

            <div class="box box-success" style="padding: 0px;">

                <div class="box-header with-border">

                    <h3 class="box-title"><i class="fa fa-search"></i> Filtros</h3>

                    <div class="box-tools pull-right">

                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

                    </div>

                </div>

                <div class="box-body">

                    <ul class="list-group list-group-unbordered">

                        <li class="list-group-item" style="border: none;">

                            <?= Form::widget(
                            [
                                'model' => $model,
                                'form' => $form,
                                'columns' => 6,
                                'attributes' =>
                                [
                                    'empresa_id' => 
                                    [
                                        'label' => 'Empresa',
                                        'type' => Form::INPUT_DROPDOWN_LIST,
                                        'items' => ArrayHelper::map($empresas, 'id', 'nomeResumo'),
                                        'options' => 
                                        [
                                            'prompt' => '',
                                        ],
                                        'columnOptions' => ['colspan' => 2]
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
                                    'ano_x' => 
                                    [
                                        'label' => FALSE,
                                        'type' => Form::INPUT_DROPDOWN_LIST,
                                        'items' => $anos_x,
                                        'options' => 
                                        [
                                            'prompt' => 'Ano',
                                        ],
                                        'columnOptions' => ['colspan' => 2]
                                    ],
                                    'meses_x' => 
                                    [
                                        'label' => FALSE,
                                        'type' => Form::INPUT_CHECKBOX_LIST,
                                        'items' => $meses,
                                        'options' => 
                                        [
                                            'inline' => TRUE,
                                            'prompt' => '',
                                            'style' => 'padding-top: 10px;'
                                        ],
                                        'columnOptions' => ['colspan' => 10]
                                    ],
                                ],
                            ]); ?>

                            <?= Form::widget(
                            [
                                'model' => $model,
                                'form' => $form,
                                'columns' => 12,
                                'attributes' =>
                                [
                                    'ano_y' => 
                                    [
                                        'label' => FALSE,
                                        'type' => Form::INPUT_DROPDOWN_LIST,
                                        'items' => $anos_y,
                                        'options' => 
                                        [
                                            'prompt' => 'Ano',
                                        ],
                                        'columnOptions' => ['colspan' => 2]
                                    ],
                                    'meses_y' => 
                                    [
                                        'label' => FALSE,
                                        'type' => Form::INPUT_CHECKBOX_LIST,
                                        'items' => $meses,
                                        'options' => 
                                        [
                                            'inline' => TRUE,
                                            'prompt' => '',
                                            'style' => 'padding-top: 10px;'
                                        ],
                                        'columnOptions' => ['colspan' => 10]
                                    ],
                                ],
                            ]); ?>

                            <?= Html::button('Pesquisar', 
                            [
                                'id' => 'btn-confronto',
                                'class' => 'btn btn-success pull-right'
                            ]); ?>

                        </li>

                    </ul>

                </div>

            </div>
        
        <?php ActiveForm::end(); ?>
          
        <div id="render-result">
        
        
        
        </div>
        
    </div>
    
</div>
    