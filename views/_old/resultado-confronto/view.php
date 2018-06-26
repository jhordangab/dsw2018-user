<?php

use yii\helpers\Html;

$this->title = 'Confronto:: ' . $empresa->razaoSocial . ' / ' . ($ano - 1) . ' x ' . $ano;
        
$this->params['breadcrumbs'][] = ['label' => 'LALUR', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<h2 class="page-header">
    <i class="fa fa-calculator"></i> <?= $this->title ?>
    <small class="pull-right">Última Atualização: <?= ($indicador) ? Yii::$app->formatter->asDate($indicador->dthr_atualizacao, 'd/M/Y H:mm') : '' ?> </small>
</h2>

<?= Html::a('<i class="fa fa-arrow-left"></i>',['index'], ['class' => 'btn btn-xs btn-default pull-left', 'style' => 'margin-bottom: 10px;', 'title' => 'Clique para voltar']) ?>

<?php if($dados): ?>

    <?php //echo Html::a('<i class="fa fa-file-pdf-o"></i>',['report',  'empresa_id' => $empresa->id, 'ano' => $ano], ['target' => '_blank', 'class' => 'btn btn-xs btn-success pull-right', 'style' => 'margin-bottom: 10px; margin-left: 5px;', 'title' => 'Clique para exportar para PDF']) ?>

    <div class="row" style="padding: 10px;">
        <?= $this->render('_partials/_table', compact('dados', 'ano')); ?>
    </div>

<?php else: ?>

    <div class="alert alert-success" style="margin-top: 50px;">Nenhum resultado foi carregado.</div>

<?php endif; ?>
