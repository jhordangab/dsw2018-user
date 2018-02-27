<?php

namespace app\controllers;

use Yii;
use app\models\Balancete;
use app\models\searches\BalanceteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use app\models\BalanceteImportForm;
use yii\web\UploadedFile;
use app\models\CategoriaPadrao;

class BalanceteController extends Controller
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
                        'actions' => ['index', 'view'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) 
                        {
                            return Yii::$app->user->identity->is_admin;
                        }
                    ],
                ],
            ]
        ];
    }

    public function actionIndex()
    {
        $searchModel = new BalanceteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        $balancetes = CategoriaPadrao::find()->getEmpresaTree(null, $model->empresa_id);
        
        return $this->render('view', [
            'model' => $model,
            'balancetes' => $balancetes
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Balancete::findOne($id)) !== null) 
        {
            return $model;
        } 
        else 
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
