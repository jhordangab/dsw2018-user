<?php
use yii\helpers\Html;

$css = <<<CSS
    
    a 
    {
        color: #727476;
    }
        
    a:hover, a:active, a:focus 
    {
        color: #056835;
    }
        
    .navbar-nav>.user-menu>.dropdown-menu
    {
        width: 100px;
    }
        
    .nav .open > a, .nav .open > a:hover, .nav .open > a:focus 
    {
        background-color: #fff;
        border-color: #ffffff;
        color: #056835;
    }
        
    .sidebar-mini:not(.sidebar-mini-expand-feature).sidebar-collapse .sidebar-menu>li:hover>a>span 
    {
        background-color: #fff;
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
        <title><?= Html::encode($this->title) ?></title>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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
