<?php

$this->title = 'Cadastrar Bandeira';
$this->params['breadcrumbs'][] = ['label' => 'Bandeiras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="bandeira-create box box-success">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
