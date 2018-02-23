<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class SiteController extends Controller
{
    public function behaviors()
    {
        return
        [
            'access' => 
            [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }
    
    public function actions()
    {
        return 
        [
            'error' => 
            [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $this->layout = 'main';
        return $this->render('index');
    }

    public function actionLogout()
    {
        Yii::$app->session['user'] = null;
        Yii::$app->user->logout();
        
        return $this->goHome();
    }
}
