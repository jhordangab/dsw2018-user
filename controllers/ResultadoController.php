<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\forms\ResultadoForm;
use app\models\AdminEmpresa;
use app\magic\ResultadoMagic;

class ResultadoController extends Controller
{
//    public $bodyClass = 'skin-blue sidebar-mini sidebar-collapse';
    
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
        $model = new ResultadoForm();
//        default values
        $model->ano = (int) date("Y") - 1;
        $model->meses = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'];
        
        $empresas = AdminEmpresa::find()->andWhere('id not in (1, 2)')->orderBy('nomeResumo ASC')->all();
        
        return $this->render('index', compact('model', 'empresas'));
    }
    
    public function actionGetData()
    {
        $this->layout = FALSE;
        $model = new ResultadoForm();
        
        if ($model->load(Yii::$app->request->post()))
        {
            $dados = ResultadoMagic::get($model);
            return $this->renderAjax('_partials/' . $model->tipo . '/_table', compact('model', 'dados'));
        }
        
        return '';
    }
}
