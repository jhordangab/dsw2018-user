<?php

$this->title = 'Alterar:: ' . $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Faixas de Faturamento', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Alterar';

?>

<div class="faixa-faturamento-update box box-success">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
