<?php

use kartik\helpers\Html;

$this->title = 'Indicadores:: ' . $empresa->razaoSocial . ' / ' . $ano;
        
$this->params['breadcrumbs'][] = ['label' => 'Indicadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
      
$js = <<<JS
        
    $('.modal_indicadores').click(function () 
    {
        var url = $(this).attr("data-link");
        var title = $(this).attr("data-title");
        $('#iframe_modal_indicadores').attr('src', url);
        $("[id^='modal_indicadores']").modal("show");
        $('.modal-backdrop').removeClass('modal-backdrop');
        $('#modal_indicadores .modal-header h3').text(title);
    });
        
    $("[id^='modal_indicadores']").on('hidden.bs.modal', function () 
    {
        window.location.reload();
    });
        
JS;

$this->registerJs($js);

?>

<?= $this->render('_wf_iframe_indicadores') ?>

<h2 class="page-header">
    <i class="fa fa-calculator"></i> <?= $this->title ?>
    <small class="pull-right">Última Atualização: <?= ($indicador) ? Yii::$app->formatter->asDate($indicador->dthr_atualizacao, 'd/M/Y H:mm') : '' ?> </small>
</h2>

<?= Html::a('<i class="fa fa-arrow-left"></i>',['index'], ['class' => 'btn btn-xs btn-default pull-left', 'style' => 'margin-bottom: 10px;', 'title' => 'Clique para voltar']) ?>

<?= Html::a('<i class="fa fa-cogs"></i> Configurar Indicadores', FALSE, 
[
    'title' => 'Configurar Indicadores',
    'class' => 'btn btn-default modal_indicadores pull-right',
    'data-link' => '/indicador/configurar?empresa_id=' . $empresa->id . '&ano=' . $ano,
    'data-title' => 'Configurar Indicadores',
    'style' => 'cursor:pointer; margin-bottom: 10px; margin-right: 25px;'
]); ?>

<?php if($dados): ?>

    <div class="row" style="padding: 10px;">
        <?= $this->render('_partials/_table', compact('dados', 'dre', 'configuracao')); ?>
    </div>

<?php else: ?>

    <div class="alert alert-success" style="margin-top: 50px;">Nenhum resultado foi carregado.</div>

<?php endif; ?>