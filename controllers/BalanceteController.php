<?php

namespace app\controllers;

use Yii;
use app\models\Balancete;
use app\models\searches\BalanceteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use app\models\CategoriaPadrao;
use app\models\BalanceteValor;

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
                        'actions' => ['index', 'view', 'update', 'delete'],
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
    
    public function actionUpdate($id)
    {
        $this->layout = '//_layout_modal';
        $model = BalanceteValor::findOne($id);
        $model->categoria_nome = ($model->categoria) ? $model->categoria->desc_codigo . ' - ' . $model->categoria->descricao : $model->categoria_id;

        if ($model->load(Yii::$app->request->post()) && $model->save(FALSE, ['valor'])) 
        {
            \Yii::$app->getSession()->setFlash('success','O valor do balancete foi alterado com sucesso.');
            $this->refresh();
        }
        else 
        {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionDelete($id)
    {
        $model = BalanceteValor::findOne($id);
        $model->is_excluido = 1;
        $model->save(FALSE, ['is_excluido']);
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
