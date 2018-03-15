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
    
    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        
        $this->layout = (Yii::$app->user->isGuest) ? 'main-login' : 'main';

        if ($exception !== null) 
        {
            return $this->render('error', 
            [
                'code' => $exception->statusCode,
                'message' => $exception->getMessage(), 
            ]);
        }
    }
}
