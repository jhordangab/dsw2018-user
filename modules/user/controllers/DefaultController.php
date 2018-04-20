<?php

namespace app\modules\user\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\httpclient\Client;

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
        if(!Yii::$app->user->isGuest)
        {
            return $this->redirect('/site/');
        }
        
        $errors = null;
        
        $model = $this->module->model("LoginForm");
        
        $post = Yii::$app->request->post();
        if ($model->load($post) && $model->validate())
        {
            $time = date('H:i:s');
            $user_uid = md5($model->email . ':' . base64_encode($model->email . $model->password) . ':' . $time);
            $url = SITE_SERVER . "/bi/rest/login/" . $user_uid . "/" . $time . "/Chrome";
            $client = new Client();
            $response = $client->createRequest()
                ->setFormat(Client::FORMAT_JSON)
                ->setMethod('get')
                ->setUrl($url)
                ->send();

            if($response->isOk)
            {
                $data = $response->getData();

                if($data['success'])
                {
                    if($model->login($data))
                    {
                        return $this->goBack();
                    }
                }
                else
                {
                    $errors = ['A senha ou o usuario estão incorretos, tente novamente!'];
                }
            }
            else
            {
                $errors = ['A senha ou o usuario estão incorretos, tente novamente!'];
            }
        }
        else 
        {
            $errors = $model->getErrors();
        }

        return $this->render('login', compact("model", "errors"));
    }
}