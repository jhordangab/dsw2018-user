<?php
use yii\helpers\Html;

$css = <<<CSS
    
    a 
    {
        color: #FFF;
    }
        
    a:hover, a:active, a:focus 
    {
        color: #FFF;
    }
        
    .nav > li > a:hover, .nav > li > a:active, .nav > li > a:focus
    {
        color: #FFF;
        background: #237486;
    }
        
    .nav .open > a, .nav .open > a:hover, .nav .open > a:focus 
    {
        background-color: #237486;
        border-color: #237486;
    }
        
    .box
    {
        padding: 20px;
    }
        
    .content
    {
        margin-top: 20px;
    }
        
    @media (max-width: 767px)
    {
        header .logo-lg img
        {
            width: 100px;
            margin-left: auto;
            margin-right: auto;
        }
    }
        
    .btn.btn-success 
    {
        color: #fff;
        background-color: #227584;
        border-color: #227584;
    }
        
    .modal-header 
    {
        border-bottom-color: #237486;
        background-color: #237486;
        color: white;
    }
        
    .close 
    {
        color: white;
        opacity: 1;
    }
        
    .glyphicon
    {
        color: #237486;
    }
        
    .table-striped > tbody > tr:nth-of-type(odd) 
    {
        background-color: #2374861f;
    }
    
    .nav-tabs > li > a
    {
        color: #555;
        background: #23748624;
    }
        
    .alert-success 
    {
        color: #FFF;
        background-color: #247388;
    }
CSS;

$this->registerCss($css);

if (Yii::$app->controller->action->id === 'login') { 
    echo $this->render(
        'main-login',
        ['content' => $content]
    );
} else {

    if (class_exists('backend\assets\AppAsset')) {
        backend\assets\AppAsset::register($this);
    } else {
        app\assets\AppAsset::register($this);
    }

    dmstr\web\AdminLteAsset::register($this);

    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/almasaeed2010-AdminLTE-b3acb63/dist');
    ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title>BPUP - Agrocontar - <?= Html::encode($this->title) ?></title>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <link rel="shortcut icon" href="/favicon.ico" />

        <?php $this->head() ?>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
    <?php $this->beginBody() ?>
    <div class="wrapper">

        <?= $this->render(
            'header.php',
            ['directoryAsset' => $directoryAsset]
        ) ?>

        <?= $this->render(
            'left.php',
            ['directoryAsset' => $directoryAsset]
        )
        ?>

        <?= $this->render(
            'content.php',
            ['content' => $content, 'directoryAsset' => $directoryAsset]
        ) ?>

    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
    <?php $this->endPage() ?>
<?php } ?>
