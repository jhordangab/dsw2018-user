<?php

use kartik\form\ActiveForm;
use kartik\builder\Form;
use kartik\helpers\Html;
use yii\helpers\ArrayHelper;

$this->title = 'Resultados';
$this->params['breadcrumbs'][] = $this->title;

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

$anos = [];

$ano_atual = (int) date('Y');
for($i = 2016; $i <= $ano_atual; $i++)
{
    $anos[$i] = "{$i}";
}

$js = <<<JS
        
    $('input[type="checkbox"]').iCheck(
    {
        checkboxClass: 'icheckbox_flat-green',
        radioClass   : 'iradio_flat-green'
    })
        
    $('#btn-resultado').click(function () 
    {
        _error = false;
        _message = "Os seguintes campos obrigatórios estão vazios: \\n\\n";
        
        if($('#resultadoform-empresa_id').val() == '')
        {
            _error = true;
            _message += " - Empresa \\n";
        }
        
        if($('#resultadoform-tipo').val() == '')
        {
            _error = true;
            _message += " - Resultado \\n";
        }
        
        if($('#resultadoform-ano').val() == '')
        {
            _error = true;
            _message += " - Ano \\n";
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
                url: '/resultado/get-data',
                data: $('#form-resultado').serialize(),
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
            'id' => 'form-resultado',
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

                        <div class="col-md-3">
                            
                            <ul class="list-group list-group-unbordered">

                                <li class="list-group-item" style="padding-bottom: 25px; border: none;">

                                    Empresa:
                                    
                                    <a class="pull-right">

                                        <?= Form::widget(
                                        [
                                            'model' => $model,
                                            'form' => $form,
                                            'columns' => 1,
                                            'attributes' =>
                                            [
                                                'empresa_id' => 
                                                [
                                                    'label' => FALSE,
                                                    'type' => Form::INPUT_DROPDOWN_LIST,
                                                    'items' => ArrayHelper::map($empresas, 'id', 'nomeResumo'),
                                                    'options' =>
                                                    [
                                                        'prompt' => ''
                                                    ]
                                                ],
                                            ],
                                        ]); ?>

                                    </a>

                                </li>

                                <li class="list-group-item" style="padding-bottom: 25px; border: none;">

                                    Resultado:
                                    
                                    <a class="pull-right">

                                        <?= Form::widget(
                                        [
                                            'model' => $model,
                                            'form' => $form,
                                            'columns' => 1,
                                            'attributes' =>
                                            [
                                                'tipo' => 
                                                [
                                                    'label' => FALSE,
                                                    'type' => Form::INPUT_DROPDOWN_LIST,
                                                    'items' => $model::$resultados,
                                                    'options' => 
                                                    [
                                                        'prompt' => ''
                                                    ]
                                                ],
                                            ],
                                        ]); ?>

                                    </a>

                                </li>

                            </ul>
                            
                        </div>
                        
                        <div class="col-md-9">
                            
                            <ul class="list-group list-group-unbordered" style="margin-bottom: 0px;">

                                <li class="list-group-item" style="border: none;">

                                    <?= Form::widget(
                                    [
                                        'model' => $model,
                                        'form' => $form,
                                        'columns' => 12,
                                        'attributes' =>
                                        [
                                            'ano' => 
                                            [
                                                'label' => FALSE,
                                                'type' => Form::INPUT_DROPDOWN_LIST,
                                                'items' => $anos,
                                                'options' => 
                                                [
                                                    'prompt' => 'Ano:',
                                                    'style' => 'margin-left: 20px;'
                                                ],
                                                'columnOptions' => ['colspan' => 2]
                                            ],
                                            'meses' => 
                                            [
                                                'label' => FALSE,
                                                'type' => Form::INPUT_CHECKBOX_LIST,
                                                'items' => $meses,
                                                'options' => 
                                                [
                                                    'inline' => TRUE,
                                                    'prompt' => ''
                                                ],
                                                'columnOptions' => ['colspan' => 12]
                                            ],
                                        ],
                                    ]); ?>

                                    <?= Html::button('Pesquisar', 
                                    [
                                        'id' => 'btn-resultado',
                                        'class' => 'btn btn-success pull-right'
                                    ]); ?>

                                </li>

                            </ul>
                            
                        </div>

                    </div>

                </div>

            </div>
        
        <?php ActiveForm::end(); ?>
                 
    </div>

    <div id="render-result" style="margin: 30px;">
        
        
        
    </div>

</div>
    