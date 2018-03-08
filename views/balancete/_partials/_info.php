<?php

use yii\helpers\Html;
use app\magic\StatusBalanceteMagic;
use yii\widgets\DetailView;

$status = StatusBalanceteMagic::getStatus($model->status);
$class = StatusBalanceteMagic::getClass($model->status);

$csstatus = "<span class='badge badge-{$class}'>&nbsp;</span> " . $status;

$js = <<<JS
        
    $('.modal_update_balancete').click(function () 
    {
        var url = $(this).attr("data-link");
        var title = $(this).attr("data-title");
        $('#iframe_modal_balancete').attr('src', url);
        $("[id^='modal_balancete']").modal("show");
        $('.modal-backdrop').removeClass('modal-backdrop');
        $('#modal_balancete .modal-header h3').text(title);
    });
        
JS;

$this->registerJs($js);

?>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => 
    [
        'empresa_nome',
        'mes',
        'ano',
        [
            'format' => 'raw',
            'attribute' => 'status',
            'value' => $csstatus
        ],
    ],
]) ?>

<?php if($model->status == StatusBalanceteMagic::STATUS_VALIDATED) : ?>

    <?= Html::a('<i class="fa fa-edit"></i> Alterar', FALSE, 
    [
        'title' => 'Alterar',
        'class' => 'btn btn-default modal_update_balancete pull-right',
        'data-link' => '/balancete/validate?id=' . $model->id,
        'data-title' => 'Alteração de Balancete',
        'style' => 'cursor:pointer; margin-bottom: 10px;'
    ]); ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => 
        [
            [
                'attribute' => 'outras_adicoes',
                'value' => ($model->outras_adicoes) ? 'R$ ' . number_format($model->outras_adicoes, 2, ',', '.') : 'R$ 0,00'
            ],
            [
                'attribute' => 'outras_exclusoes',
                'value' => ($model->outras_exclusoes) ? 'R$ ' . number_format($model->outras_exclusoes, 2, ',', '.') : 'R$ 0,00'
            ],
            [
                'attribute' => 'base_negativa',
                'value' => ($model->base_negativa) ? 'R$ ' . number_format($model->base_negativa, 2, ',', '.') : 'R$ 0,00'
            ],
            [
                'attribute' => 'csll_retida',
                'value' => ($model->csll_retida) ? 'R$ ' . number_format($model->csll_retida, 2, ',', '.') : 'R$ 0,00'
            ],
            [
                'attribute' => 'prejuizo_anterior_compensar',
                'value' => ($model->prejuizo_anterior_compensar) ? 'R$ ' . number_format($model->prejuizo_anterior_compensar, 2, ',', '.') : 'R$ 0,00'
            ],
            [
                'attribute' => 'base_negativa_irpj',
                'value' => ($model->base_negativa_irpj) ? 'R$ ' . number_format($model->base_negativa_irpj, 2, ',', '.') : 'R$ 0,00'
            ],
            [
                'attribute' => 'irrf_mes',
                'value' => ($model->irrf_mes) ? 'R$ ' . number_format($model->irrf_mes, 2, ',', '.') : 'R$ 0,00'
            ],
            [
                'attribute' => 'valuation_metodo_ebitda',
                'value' => ($model->valuation_metodo_ebitda) ? $model->valuation_metodo_ebitda : '0'
            ],
            [
                'attribute' => 'custo_capital_proprio',
                'value' => $model->custo_capital_proprio . '%'
            ],
        ],
    ]) ?>

<?php endif; ?>