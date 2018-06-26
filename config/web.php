<?php

use kartik\mpdf\Pdf;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
require(__DIR__ . '/config-local.php');
setlocale(LC_ALL, null);
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');

$config = [
    'id' => 'agrocontar',
    'name' => 'Agrocontar',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'pt-BR',
    'timeZone' => 'America/Sao_Paulo',
    'aliases' => 
    [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules' => 
    [
        'user' => 
        [
            'class' => 'app\modules\user\Module',
        ],
        'gridview' => [
            'class' => '\kartik\grid\Module'
        ],
    ],
    'components' => 
    [
        'pdf' => 
        [
            'class' => Pdf::classname(),
            'format' => Pdf::FORMAT_A4,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
        ],
        'formatter' => 
        [
            'class' => 'yii\i18n\formatter',
            'thousandSeparator' => '.',
            'decimalSeparator' => ',',
        ],
        'request' => 
        [
            'cookieValidationKey' => 'mlKdROOiahYA_57c3jx2D3SkysNb7Vm4',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'view' => 
        [
            'theme' => 
            [
                'pathMap' => 
                [
                   '@app/views' => '@app/views/layout'
                ],
            ],
        ],
        'assetManager' => 
        [
            'bundles' => 
            [
                'dmstr\web\AdminLteAsset' => 
                [
                    'skin' => 'skin-black',
                ],
            ],
        ],
        'user' => 
        [
            'loginUrl' => '/user/login',
            'class' => 'app\modules\user\components\User',
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => false,
            'enableSession' => true,
            'identityCookie' => 
            [
                'name' => '_agrocontarUser'
            ]
        ],
        'session' => 
        [
            'class' => 'yii\web\Session',
            'cookieParams' => ['httponly' => true, 'lifetime' => 3600 * 4],
            'timeout' => 3600 * 4,
            'useCookies' => true,
        ],
        'errorHandler' => 
        [
            'errorAction' => 'site/error',
        ],
        'mailer' => 
        [
            'class' => 'yii\swiftmailer\Mailer',
            'transport' => 
            [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtplw.com.br',
                'username' => 'bpone',
                'password' => 'vdqmeezV2399',
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],
        'log' => 
        [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => 
            [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => 
        [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [],
        ],
    ],
    'params' => $params,
];

if (FALSE) 
{
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 
    [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 
    [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['*'],
    ];
}

return $config;
