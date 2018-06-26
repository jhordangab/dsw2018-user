<?php

$this->title = 'Cadastrar Região';
$this->params['breadcrumbs'][] = ['label' => 'Regiões', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="regiao-create box box-success">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
