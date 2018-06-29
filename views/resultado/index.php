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

            <div class="box box-success box-filter">

                <div class="box-header with-border">

                    <h3 class="box-title"><i class="fa fa-search"></i> Filtros</h3>

                    <div class="box-tools pull-right">

                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

                    </div>

                </div>

                <div class="box-body">

                    <ul class="list-group list-group-unbordered">

                        <li class="list-group-item">

                            <?= Form::widget(
                            [
                                'model' => $model,
                                'form' => $form,
                                'columns' => 2,
                                'attributes' =>
                                [
                                    'empresa_id' => 
                                    [
                                        'label' => 'Empresa',
                                        'type' => Form::INPUT_DROPDOWN_LIST,
                                        'items' => ArrayHelper::map($empresas, 'id', 'nomeResumo'),
                                        'options' =>
                                        [
                                            'prompt' => ''
                                        ]
                                    ],
                                    'tipo' => 
                                    [
                                        'label' => 'Tipo de Resultado',
                                        'type' => Form::INPUT_DROPDOWN_LIST,
                                        'items' => $model::$resultados,
                                        'options' => 
                                        [
                                            'prompt' => ''
                                        ]
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
                                    'ano' => 
                                    [
                                        'label' => FALSE,
                                        'type' => Form::INPUT_DROPDOWN_LIST,
                                        'items' => $anos,
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
                                            'prompt' => '',
                                            'style' => 'padding-top: 10px;'
                                        ],
                                        'columnOptions' => ['colspan' => 10]
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

        <?php ActiveForm::end(); ?>
        
        <div id="render-result" class="table-responsive">
        
        
        
        </div>
        
    </div>
                 
</div>