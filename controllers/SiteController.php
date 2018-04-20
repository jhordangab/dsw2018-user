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
            if (!Yii::$app->user->getIsGuest()) 
            {
                $message = '';
                $message .= 'ID: <b>' . Yii::$app->user->identity->id . '</b><br>';
                $message .= 'Nome: <b>' . Yii::$app->user->identity->nome . '</b><br>';
                $message .= 'Eempresa: <b>' . Yii::$app->user->identity->empresa_nome . '</b><br>';

                foreach ($_SERVER as $key => $data) 
                {
                    if (strpos($key, 'DB_') === false) 
                    {
                        $message .= $key . ': <b>' . $data . '</b><br>';
                    }
                }

                $message .= "<br />--------------------------------------------<br />";
                $message .= "EXCEPTION <br />";
                $message .= "<pre>" . $exception . "</pre>";
                $message .= 'IP: <b>' . IPUSER . '</b><br>';
                $message .= 'URL: <b>' . Yii::$app->request->getUrl() . '</b><br>';
                $message .= 'Mensagem: <b>' . $exception->getMessage() . '</b>';

                if(!preg_match('#\b(assets|apple)\b#', Yii::$app->request->getUrl(), $matches))
                {                   
                    Yii::$app->mailer->compose()
                    ->setFrom('bp1@bpone.com.br')
                    ->setTo('matheus.junior@bp1.com.br')
                    ->setSubject('Erro no BPUP')
                    ->setHtmlBody($message)
                    ->send();
                }
            }

            return $this->render('error', 
            [
                'code' => $exception->statusCode,
                'message' => $exception->getMessage(), 
            ]);
        }
    }
}
