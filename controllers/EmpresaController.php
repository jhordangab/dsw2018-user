<?php

namespace app\controllers;

use Yii;
use app\models\AdminEmpresa;
use app\models\searches\AdminEmpresaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use app\models\EmpresaDado;

class EmpresaController extends Controller
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
                        'actions' => ['index', 'update'],
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
        $searchModel = new AdminEmpresaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $dados = EmpresaDado::find()->andWhere([
            'is_ativo' => TRUE,
            'is_excluido' => FALSE,
            'empresa_id' => $id
        ])->one();
        
        if(!$dados)
        {
            $dados = new EmpresaDado();
            $dados->empresa_id = $id;
        }

        if ($dados->load(Yii::$app->request->post()) && $dados->save())
        {
            \Yii::$app->getSession()->setFlash('success','Dados da empresa salvo com sucesso.');
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'dados' => $dados
        ]);
    }
    
    protected function findModel($id)
    {
        if (($model = AdminEmpresa::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
