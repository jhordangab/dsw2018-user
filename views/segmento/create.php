<?php

$this->title = 'Cadastrar Segmento';
$this->params['breadcrumbs'][] = ['label' => 'Segmentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="segmento-create box box-success">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
