<?php

$this->title = 'Alterar:: ' . $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Bandeiras', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Alterar';

?>

<div class="bandeira-update box box-success">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
