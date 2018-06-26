<?php
use yii\helpers\Html;

$css = <<<CSS
    
    a 
    {
        color: #FFF;
    }
      
    table a, table a:hover, table a:focus
    {
        color: #237486;
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
        
    .btn.btn-success, .btn-success:active:hover, .btn-success.active:focus
    {
        background-color: #26808f;
        border-color: #26808f;
    }
        
    .modal-header 
    {
        background-color: #237486;
        color: white;
    }
        
    .close 
    {
        color: white;
        opacity: 1;
    }
        
    .glyphiconssd
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
        border-color: white !important;
    }
        
    .pagination > .active > a, .pagination > .active > span, .pagination > .active > a:hover, .pagination > .active > span:hover, .pagination > .active > a:focus, .pagination > .active > span:focus 
    {
        background-color: #237486;
        border-color: #237486;
    }
        
    .alert.alert-success 
    {
        color: #FFF;
        background-color: #247388 !important;
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
        
    .sidebar-mini:not(.sidebar-mini-expand-feature).sidebar-collapse .sidebar-menu>li:hover>a>span:not(.pull-right), .sidebar-mini:not(.sidebar-mini-expand-feature).sidebar-collapse .sidebar-menu>li:hover>.treeview-menu 
    {
        background-color: #22415a;
        color: #FFF;
    }  
        
    .margin10
    {
        margin: 10px;
    }
        
    .amcharts-export-menu li > a
    {
        color: #FFF;
    }
        
    .amcharts-export-menu li:hover > a, .amcharts-export-menu li.active > a
    {
        background-color: #247388;
    }
        
    .sidebar-menu .active > .treeview-menu 
    {
        background-color: #26808f52;
    }
        
    .box.box-success
    {
        border-top-color: #26808f;
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
    \app\assets\ICheckAsset::register($this);
    
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
    <body class="<?= isset($this->context->bodyClass) ? $this->context->bodyClass : 'hold-transition skin-blue sidebar-mini' ?>">
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
        
        <div class="div-loading"></div>

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
