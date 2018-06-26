<?php

$this->title = 'Alterar:: ' . $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Segmentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Alterar';

?>

<div class="segmento-update box box-success">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
