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

            <div class="col-md-12">

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

                                <div class="col-md-12">
                                    
                                    <div class="col-md-2" style="padding-left: 0px;">Empresa:</div>
                                        
                                    <div class="col-md-2">
                                    
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
                                                        'prompt' => '',
                                                    ],
                                                ],
                                            ],
                                        ]); ?>
                                        
                                    </div>
                                    
                                </div>
                                
                                <div class="col-md-12">
                                    
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
                                                    'prompt' => 'Ano Principal:',
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
                                                    'prompt' => ''
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
                                                    'prompt' => 'Ano de Confronto:',
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
                                                    'prompt' => ''
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
                                    
                                </div>

                            </li>

                        </ul>

                    </div>

                </div>

            </div>
        
        <?php ActiveForm::end(); ?>
                 
    </div>

    <div id="render-result" style="margin: 30px;">
        
        
        
    </div>

</div>
    