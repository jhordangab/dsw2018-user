<?php

use kartik\helpers\Html;

$this->title = 'Indicadores:: ' . $empresa->razaoSocial . ' / ' . $ano;
        
$this->params['breadcrumbs'][] = ['label' => 'Indicadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
        
?>

<h2 class="page-header">
    <i class="fa fa-calculator"></i> <?= $this->title ?>
    <small class="pull-right">Última Atualização: <?= ($indicador) ? Yii::$app->formatter->asDate($indicador->dthr_atualizacao, 'd/M/Y H:mm') : '' ?> </small>
</h2>

<?= Html::a('<i class="fa fa-arrow-left"></i>',['index'], ['class' => 'btn btn-xs btn-default pull-left', 'style' => 'margin-bottom: 10px;', 'title' => 'Clique para voltar']) ?>

<?php if($dados): ?>

    <div class="row" style="padding: 10px;">
        <?= $this->render('_partials/_table', compact('dados')); ?>
    </div>

<?php else: ?>

    <div class="alert alert-success" style="margin-top: 50px;">Nenhum resultado foi carregado.</div>

<?php endif; ?>