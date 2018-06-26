<?php

use kartik\form\ActiveForm;
use kartik\builder\Form;
use kartik\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\EstadoRegiao;
use app\models\FaixaFaturamento;
use app\models\Bandeira;
use app\models\Segmento;
use app\models\AdminEmpresa;

$this->title = 'Média de Mercado';
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

$anos = [];

for($i = 2016; $i < 2022; $i++)
{
    $anos[$i] = "{$i}";
}

$empresas = AdminEmpresa::find()->andWhere('id not in (1, 2)')->orderBy('nomeResumo ASC')->all();

?>

<div class="row">

    <div class="col-lg-12">
        
        <?php $form = ActiveForm::begin([
            'type' => ActiveForm::TYPE_VERTICAL,
        ]); ?>

            <div class="col-md-3">

                <div class="box box-success">

                    <div class="box-body">

                        <h3 class="profile-username text-center">Dados:</h3>

                        <ul class="list-group list-group-unbordered">

                            <li class="list-group-item" style="padding-bottom: 25px;">

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
                                            ],
                                        ],
                                    ]); ?>

                                </a>

                            </li>

                            <li class="list-group-item" style="padding-bottom: 25px;">

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
                                                'options' => 
                                                [
                                                    'prompt' => ''
                                                ]
                                            ],
                                        ],
                                    ]); ?>

                                </a>

                            </li>

                            <li class="list-group-item" style="padding-bottom: 25px;">

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

                </div>

            </div>

            <div class="col-md-9">

                <div class="box box-success">

                    <div class="box-body" style="padding-bottom: 3px;">

                        <h3 class="profile-username text-center">Geral:</h3>

                        <ul class="list-group list-group-unbordered" style="margin-bottom: 0px;">

                            <li class="list-group-item" style="border-bottom: none;">

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

                                <?= Html::submitButton('Pesquisar', 
                                [
                                    'class' => 'btn btn-success pull-right',
                                    'style' => 'margin-top: -40px;'
                                ]); ?>

                            </li>

                        </ul>

                    </div>

                </div>

            </div>
        
        <?php ActiveForm::end(); ?>
                 
    </div>

<!--    <div class="col-lg-12">
        
        <div class="box box-success">

            <div class="box-body">

                        
            </div>

        </div>
        
    </div>-->

</div>
    