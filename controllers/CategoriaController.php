<?php

namespace app\controllers;

use Yii;
use app\models\CategoriaPadrao;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;

class CategoriaController extends Controller
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
                        'actions' => ['index', 'create', 'update', 'delete'],
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
        $balancetes = CategoriaPadrao::find()->getTree();

        return $this->render('index', compact('balancetes'));
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate($pai_id)
    {
        $this->layout = '//_layout_modal';
        $categoria_pai = CategoriaPadrao::findOne($pai_id);
        
        $model = new CategoriaPadrao();
        $model->codigo_pai = $categoria_pai->codigo;
        $model->desc_categoria_pai = $categoria_pai->desc_codigo . ' - ' . $categoria_pai->descricao;

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            if(strlen($model->codigo) > 6)
            {
                $model->is_service = TRUE;
                $model->save(FALSE, ['is_service']);
            }
            \Yii::$app->getSession()->setFlash('success','A categoria foi cadastrada com sucesso.');
            $this->refresh();
        }
        else 
        {
            return $this->render('create', 
            [
                'model' => $model,
                'categoria_pai' => $categoria_pai
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $this->layout = '//_layout_modal';
        $model = $this->findModel($id);
        $categoria_pai = CategoriaPadrao::findOne(['codigo' => $model->codigo_pai]);
        $model->desc_categoria_pai = $categoria_pai->desc_codigo . ' - ' . $categoria_pai->descricao;

        if ($model->load(Yii::$app->request->post()) && $model->save()) 
        {
            \Yii::$app->getSession()->setFlash('success','A categoria foi alterada com sucesso.');
            $this->refresh();
        }
        else 
        {
            return $this->render('update', [
                'model' => $model,
                'categoria_pai' => $categoria_pai
            ]);
        }
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->is_excluido = 1;
        $model->save(FALSE, ['is_excluido']);
    }

    protected function findModel($id)
    {
        if (($model = CategoriaPadrao::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
