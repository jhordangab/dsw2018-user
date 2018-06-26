<?php

$this->title = 'Cadastrar Faixa de Faturamento';
$this->params['breadcrumbs'][] = ['label' => 'Faixas de Faturamento', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="faixa-faturamento-create box box-success">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
