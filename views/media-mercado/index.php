<?php

use kartik\form\ActiveForm;
use kartik\builder\Form;
use kartik\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\EstadoRegiao;
use app\models\FaixaFaturamento;
use app\models\Bandeira;
use app\models\Segmento;

$this->title = 'Média de Mercado';
$this->params['breadcrumbs'][] = $this->title;

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
        
    $('#btn-mediamercado').click(function () 
    {
        _error = false;
        _message = "Os seguintes campos obrigatórios estão vazios: \\n\\n";
        
        if($('#mediamercadoform-empresa_id').val() == '')
        {
            _error = true;
            _message += " - Empresa \\n";
        }
        
        if($('#mediamercadoform-mes').val() == '')
        {
            _error = true;
            _message += " - Mês \\n";
        }
        
        if($('#mediamercadoform-ano').val() == '')
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
                url: '/media-mercado/get-data',
                data: $('#form-mediamercado').serialize(),
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
            'id' => 'form-mediamercado',
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

                    <div class="col-md-3">

                        <ul class="list-group list-group-unbordered">

                            <li class="list-group-item">

                                <b>Empresa:</b> <a class="pull-right">

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

                            <li class="list-group-item">

                                <b>Mês:</b> <a class="pull-right">

                                    <?= Form::widget(
                                    [
                                        'model' => $model,
                                        'form' => $form,
                                        'columns' => 1,
                                        'attributes' =>
                                        [
                                            'mes' => 
                                            [
                                                'label' => FALSE,
                                                'type' => Form::INPUT_DROPDOWN_LIST,
                                                'items' => $meses,
                                            ],
                                        ],
                                    ]); ?>

                                </a>

                            </li>

                            <li class="list-group-item">

                                <b>Ano:</b> <a class="pull-right">

                                    <?= Form::widget(
                                    [
                                        'model' => $model,
                                        'form' => $form,
                                        'columns' => 1,
                                        'attributes' =>
                                        [
                                            'ano' => 
                                            [
                                                'label' => FALSE,
                                                'type' => Form::INPUT_DROPDOWN_LIST,
                                                'items' => $anos,
                                             ],
                                        ],
                                    ]); ?>

                                </a>

                            </li>

                        </ul>

                    </div>
                    
                    <div class="col-md-9">

                        <ul class="list-group list-group-unbordered">

                            <li class="list-group-item" style="border: none;">

                                <?= Form::widget(
                                [
                                    'model' => $model,
                                    'form' => $form,
                                    'columns' => 4,
                                    'attributes' =>
                                    [
                                        'regiao_id' => 
                                        [
                                            'label' => 'Região',
                                            'type' => Form::INPUT_CHECKBOX_LIST,
                                            'items' => ArrayHelper::map(EstadoRegiao::find()->andWhere([
                                                'is_ativo' => TRUE, 
                                                'is_excluido' => FALSE
                                            ])->orderBy('regiao')->groupBy('regiao')->all(), 'id', 'regiao'),
                                        ],
                                        'bandeira_id' => 
                                        [
                                            'label' => 'Bandeira',
                                            'type' => Form::INPUT_CHECKBOX_LIST,
                                            'items' => ArrayHelper::map(Bandeira::find()->andWhere([
                                                'is_ativo' => TRUE, 
                                                'is_excluido' => FALSE
                                            ])->orderBy('referencia')->all(), 'id', 'referencia'),
                                        ],
                                        'segmento_id' => 
                                        [
                                            'label' => 'Segmento',
                                            'type' => Form::INPUT_CHECKBOX_LIST,
                                            'items' => ArrayHelper::map(Segmento::find()->andWhere([
                                                'is_ativo' => TRUE, 
                                                'is_excluido' => FALSE
                                            ])->orderBy('referencia')->all(), 'id', 'referencia'),
                                        ],
                                        'faturamento_id' => 
                                        [
                                            'label' => 'Faturamento',
                                            'type' => Form::INPUT_CHECKBOX_LIST,
                                            'items' => ArrayHelper::map(FaixaFaturamento::find()->andWhere([
                                                'is_ativo' => TRUE, 
                                                'is_excluido' => FALSE
                                            ])->orderBy('nome')->all(), 'id', 'nome'),
                                        ],
                                    ],
                                ]); ?>

                                <?= Html::button('Pesquisar', 
                                [
                                    'id' => 'btn-mediamercado',
                                    'class' => 'btn btn-success pull-right'
                                ]); ?>

                            </li>

                        </ul>
                        
                    </div>

                </div>

            </div>
        
        <?php ActiveForm::end(); ?>
                 
        <div id="render-result" class="table-responsive">
        
        
        
        </div>
        
    </div>

</div>
    