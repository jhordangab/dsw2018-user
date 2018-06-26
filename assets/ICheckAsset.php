<?php

namespace app\assets;

use yii\web\AssetBundle;

class ICheckAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/plugins/iCheck';
    public $css = [
        'all.css'       
    ];
    public $js = [
        'icheck.min.js'
    ];
    public $depends = [
        'dmstr\web\AdminLteAsset',
    ];
}