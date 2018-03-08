<?php

use app\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
$this->beginPage();


$css = <<<CSS
     
    .btn.btn-success 
    {
        color: #fff;
        background-color: #227584;
        border-color: #227584;
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

                        <?= $content; ?>
                            
                    <?php endif; ?>
			        
                </div>
            </div>
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>

	