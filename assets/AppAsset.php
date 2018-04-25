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
        'css/iziToast.min.css',
        'https://www.amcharts.com/lib/3/plugins/export/export.css'
    ];
    
    public $js = 
    [
        'js/iziToast.min.js',
        'js/js_custom.js',
        'https://www.amcharts.com/lib/3/amcharts.js',
        'https://www.amcharts.com/lib/3/serial.js',
        'https://www.amcharts.com/lib/3/plugins/export/export.min.js',
        'https://www.amcharts.com/lib/3/themes/light.js'
    ];
    
    public $depends = 
    [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
