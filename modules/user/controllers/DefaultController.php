<?php

namespace app\modules\user\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class DefaultController extends Controller
{
    public $module;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login'],
                        'allow' => true,
                    ],
                ],
            ],
            'verbs' => 
            [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionLogin()
    {        
        if (!\Yii::$app->user->isGuest) 
        {
            return $this->goHome();
        }
 
        $model = $this->module->model("LoginForm");
        
        if ($model->load(Yii::$app->request->post()) && $model->login()) 
        {
            return $this->goBack();
        } 
        else 
        {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
}