<?php

use app\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
$this->beginPage();


$css = <<<CSS
     
    .btn.btn-success, .btn-success:active:hover, .btn-success.active:focus
    {
        background-color: #26808f;
        border-color: #26808f;
    }
        
    .alert-success 
    {
        color: #FFF;
        background-color: #247388;
        border-color: white !important;
    }
        
    .div-loading
    {
        display:    none;
        position:   fixed;
        z-index:    1000;
        top:        0;
        left:       0;
        height:     100%;
        width:      100%;
        background: rgba( 255, 255, 255, .8 ) 
                    url('/img/loading.gif') 
                    50% 50% 
                    no-repeat;
    }

    .div-loading.loading 
    {
        overflow: hidden;   
    }

    .div-loading.loading
    {
        display: block;
    }
        
CSS;

$this->registerCss($css);

?>
<html>
    <head>
        <?php $this->head();?>
        <?= Html::csrfMetaTags(); ?>
    </head>
    <body style="background-color: #fff;">
        <?php $this->beginBody() ?>
        <div class="panel-body" style='background-color: #f6f6f6; padding:0px;'>
            <div class="panel" style="margin-bottom:0px;">
                <div class="panel-body">
                                    
                    <?php if (Yii::$app->session->getAllFlashes()) : ?>

                        <?php foreach (Yii::$app->session->getAllFlashes() as $key => $message) : ?>

                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <div class="alert alert-<?= $key; ?>"> <?= $message; ?> </div>

                        <?php endforeach; ?>
                        
                    <?php else: ?>
                            
                        <div class="div-loading"></div>

                        <?= $content; ?>
                            
                    <?php endif; ?>
			        
                </div>
            </div>
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>

	