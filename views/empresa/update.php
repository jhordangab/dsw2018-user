<?php

$this->title = 'Alterar dados:: ' . $model->nomeResumo;
$this->params['breadcrumbs'][] = ['label' => 'Empresas', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Alterar';

?>

<div class="empresa-update box box-success">

    <?= $this->render('_form', [
        'model' => $model,
        'dados' => $dados
    ]) ?>

</div>
