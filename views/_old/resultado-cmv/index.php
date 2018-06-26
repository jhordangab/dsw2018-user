<?php

use yii\helpers\Url;

$this->title = 'CMVs';
$this->params['breadcrumbs'][] = $this->title;

$css = <<<CSS
        
    .bg-card-empresas
    {
        background-color: #237486 !important;
    }    
        
CSS;

$this->registerCss($css);

?>

<h2 class="page-header">
    <i class="fa fa-calculator"></i> <?= $this->title ?>
    <small class="pull-right">Última Atualização: <?= ($indicador) ? Yii::$app->formatter->asDate($indicador->dthr_atualizacao, 'd/M/Y H:mm') : '' ?> </small>
</h2>

<div class="row">
        
    <?php foreach($empresas as $empresa) : ?>
        
        <div class="col-lg-3 col-xs-6">
        
            <div class="small-box bg-green bg-card-empresas">

                <div class="inner">

                    <h3><?= $empresa->nomeResumo; ?></h3>

                    <p><?= $empresa->razaoSocial; ?></p>

                </div>
                
                <div class="icon">

                    <i class="fa fa-calculator"></i>

                </div>
                
                <?php foreach($empresa->getAnos() as $ano): ?>

                    <a href="<?= Url::toRoute(['view', 'empresa_id' => $empresa->id, 'ano' => $ano['ano']]); ?>" class="small-box-footer"><?= $ano['ano'] ?> <i class="fa fa-arrow-circle-right"></i></a>
                
                <?php endforeach; ?>
                    
            </div>

        </div>
            
    <?php endforeach; ?>
    
</div>