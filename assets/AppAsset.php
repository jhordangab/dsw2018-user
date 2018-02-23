<?php

namespace app\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';

    public $baseUrl = '@web';

    public $css = 
    [
        'css/site.css',
        'css/iziToast.min.css'
    ];
    
    public $js = 
    [
        'js/iziToast.min.js'
    ];
    
    public $depends = 
    [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
