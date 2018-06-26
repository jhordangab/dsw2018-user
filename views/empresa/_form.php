
<?php

use kartik\form\ActiveForm;
use kartik\builder\Form;
use kartik\helpers\Html;
use app\models\EstadoRegiao;
use app\models\FaixaFaturamento;
use app\models\Bandeira;
use app\models\Segmento;
use yii\helpers\ArrayHelper;

?>

<div class="row" style="padding: 10px;">

    <?php $form = ActiveForm::begin([
        'type' => ActiveForm::TYPE_VERTICAL,
    ]); ?>
    
    <?= Form::widget(
    [
        'model' => $model,
        'form' => $form,
        'columns' => 2,
        'attributes' =>
        [
            'nomeResumo' => 
            [
                'label' => 'Empresa',
                'type' => Form::INPUT_HIDDEN_STATIC
            ],
            'razaoSocial' => 
            [
                'label' => 'Razão Social',
                'type' => Form::INPUT_HIDDEN_STATIC
            ]
        ],
    ]); ?>
    
    <?= Form::widget(
    [
        'model' => $dados,
        'form' => $form,
        'columns' => 12,
        'attributes' =>
        [
            'regiao_id' => 
            [
                'type' => Form::INPUT_DROPDOWN_LIST,
                'items' => ArrayHelper::map(EstadoRegiao::find()->andWhere([
                    'is_ativo' => TRUE, 
                    'is_excluido' => FALSE
                ])->orderBy('nome_estado')->all(), 'id', 'nome_estado'),
                'options' =>
                [
                    'prompt' => ''
                ],
                'columnOptions' => ['colspan' => 2]
            ],
            'unidade' => 
            [
                'type' => Form::INPUT_TEXT,
                'columnOptions' => ['colspan' => 4]
            ],
            'faixa_faturamento_id' => 
            [
                'type' => Form::INPUT_DROPDOWN_LIST,
                'items' => ArrayHelper::map(FaixaFaturamento::find()->andWhere([
                    'is_ativo' => TRUE, 
                    'is_excluido' => FALSE
                ])->orderBy('faturamento_inicial')->all(), 'id', 'nome'),
                'options' =>
                [
                    'prompt' => ''
                ],
                'columnOptions' => ['colspan' => 2]
            ],
            'bandeira_id' => 
            [
                'type' => Form::INPUT_DROPDOWN_LIST,
                'items' => ArrayHelper::map(Bandeira::find()->andWhere([
                    'is_ativo' => TRUE, 
                    'is_excluido' => FALSE
                ])->orderBy('nome')->all(), 'id', 'nome'),
                'options' =>
                [
                    'prompt' => ''
                ],
                'columnOptions' => ['colspan' => 2]
            ],
            'segmento_id' => 
            [
                'type' => Form::INPUT_DROPDOWN_LIST,
                'items' => ArrayHelper::map(Segmento::find()->andWhere([
                    'is_ativo' => TRUE, 
                    'is_excluido' => FALSE
                ])->orderBy('nome')->all(), 'id', 'nome'),
                'options' =>
                [
                    'prompt' => ''
                ],
                'columnOptions' => ['colspan' => 2]
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
    