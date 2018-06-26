<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\forms\ConfrontoForm;
use app\magic\ConfrontoBiMagic;
use app\models\AdminEmpresa;

class ConfrontoController extends Controller
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
        $model = new ConfrontoForm();
//        default values
        $model->ano_x = (int) date("Y") - 1;
        $model->ano_y = (int) date("Y");
        $model->meses_y = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'];
        $model->meses_x = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'];
        
        $empresas = AdminEmpresa::find()->andWhere('id not in (1, 2)')->orderBy('nomeResumo ASC')->all();
        
        return $this->render('index', compact('model', 'empresas'));
    }
    
    public function actionGetData()
    {
        $this->layout = FALSE;
        $model = new ConfrontoForm();
        
        if ($model->load(Yii::$app->request->post()))
        {
            $dados = ConfrontoBiMagic::get($model);
            return $this->renderAjax('_partials/_table', compact('model', 'dados'));
        }
        
        return '';
    }
}
