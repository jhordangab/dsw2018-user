<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\forms\MediaMercadoForm;
use app\magic\MediaMercadoMagic;
use app\models\AdminEmpresa;

class MediaMercadoController extends Controller
{
    public function behaviors()
    {
        return 
        [
            'access' => 
            [
                'class' => AccessControl::className(),
                'rules' => 
                [
                    [
                        'actions' => ['index', 'get-data'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) 
                        {
                            return in_array(Yii::$app->user->identity->perfil_id, ['1', '26']);
                        }
                    ],
                ],
            ],
        ];
    }
    
    public function actionIndex()
    {
        $model = new MediaMercadoForm();
//        default values
        $model->ano = (int) date("Y") - 1;
        $model->mes = ((int) date("m") > 1) ? (int) date("m") - 1 : 1;
        
        $empresas = AdminEmpresa::find()->andWhere('id not in (1, 2)')->orderBy('nomeResumo ASC')->all();
        
        return $this->render('index', compact('model', 'empresas'));
    }
    
    public function actionGetData()
    {
        $this->layout = FALSE;
        $model = new MediaMercadoForm();
        
        if ($model->load(Yii::$app->request->post()))
        {
            $dados = MediaMercadoMagic::get($model);
            return $this->renderAjax('_partials/_data', compact('model', 'dados'));
        }
        
        return '';
    }
}
