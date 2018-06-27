<?php

use kartik\form\ActiveForm;
use kartik\builder\Form;
use kartik\helpers\Html;
use yii\helpers\ArrayHelper;

$this->title = 'Indicadores';
$this->params['breadcrumbs'][] = $this->title;

$js = <<<JS
        
    $('input[type="checkbox"]').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass   : 'iradio_flat-green'
    })
        
JS;

$this->registerJs($js);

$anos = [];
$ano_atual = (int) date('Y');

for($i = 2016; $i <= $ano_atual; $i++)
{
    $anos[$i] = "{$i}";
}

$js = <<<JS
        
    $('#btn-indicador').click(function () 
    {
        _error = false;
        _message = "Os seguintes campos obrigatórios estão vazios: \\n\\n";
        
        if($('#indicadorform-empresa_id').val() == '')
        {
            _error = true;
            _message += " - Empresa \\n";
        }
        
        if($('#indicadorform-ano').val() == '')
        {
            _error = true;
            _message += " - Ano Principal \\n";
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
                url: '/indicador/get-data',
                data: $('#form-indicador').serialize(),
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

<?= $this->render('_wf_iframe_indicadores') ?>

<div class="row">

    <div class="col-lg-12">
        
        <?php $form = ActiveForm::begin([
            'id' => 'form-indicador',
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
                                    ],
                                    'ano' => 
                                    [
                                        'label' => 'Ano',
                                        'type' => Form::INPUT_DROPDOWN_LIST,
                                        'items' => $anos,
                                        'options' => 
                                        [
                                            'prompt' => '',
                                        ],
                                        'columnOptions' => ['colspan' => 2]
                                    ],
                                ],
                            ]); ?>

                            <?= Html::button('Pesquisar', 
                            [
                                'id' => 'btn-indicador',
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
    