<?php

namespace app\controllers;

use Yii;
use app\models\FaixaFaturamento;
use app\models\searches\FaixaFaturamentoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;

class FaixaFaturamentoController extends Controller
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
                        'actions' => ['index', 'create', 'update', 'status', 'delete'],
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
        $searchModel = new FaixaFaturamentoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionCreate()
    {
        $model = new FaixaFaturamento();

        if ($model->load(Yii::$app->request->post()) && $model->save()) 
        {
            \Yii::$app->getSession()->setFlash('success','Faixa de Faturamento cadastrada com sucesso.');
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            \Yii::$app->getSession()->setFlash('success','Faixa de Faturamento alterada com sucesso.');
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionStatus($id)
    {
        $model = $this->findModel($id);
        $status = !($model->is_ativo);
        $model->is_ativo = $status;
        $model->save(FALSE, ['is_ativo']);
        \Yii::$app->getSession()->setFlash('success','Status alterado com sucesso.');
        return $this->redirect(['index']);
    }
    
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->is_excluido = 1;
        $model->save(FALSE, ['is_excluido']);
        \Yii::$app->getSession()->setFlash('success','Faixa de Faturamento excluída com sucesso.');
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = FaixaFaturamento::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
