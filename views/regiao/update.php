<?php

$this->title = 'Alterar:: ' . $model->nome_estado;
$this->params['breadcrumbs'][] = ['label' => 'Regiões', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Alterar';

?>

<div class="regiao-update box box-success">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
