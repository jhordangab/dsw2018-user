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
use app\models\LogImportacao;

class MeusBalancetesController extends Controller
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
                        'actions' => ['index', 'view', 'import', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) 
                        {
                            return !in_array(Yii::$app->user->identity->perfil_id, ['1', '26']);
                        }
                    ],
                ],
            ]
        ];
    }

    public function actionIndex()
    {
        $searchModel = new BalanceteSearch();
        $searchModel['empresa_id'] = Yii::$app->user->identity->empresa_id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $balancetes = CategoriaPadrao::find()->getEmpresaTree();
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'balancetes' => $balancetes
        ]);
    }

    public function actionImport()
    {
        $this->layout = '//_layout_modal';
        
        $model = new BalanceteImportForm();
        $model->empresa_id = Yii::$app->user->identity->empresa_id;
        $model->empresa_nome = Yii::$app->user->identity->empresa_nome;
        
        if ($model->load(Yii::$app->request->post())) 
        {
            $model->file = UploadedFile::getInstance($model, 'file');
            
            if($model->validate() && $model->save())
            {
                \Yii::$app->getSession()->setFlash('success','O balancete foi importado com sucesso.');
            }
        }
        
        return $this->render('create',
        [
            'model' => $model,
        ]);
    }
    
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        
        if($model->status !== 'S')
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        
        $model->is_excluido = 1;
        $model->save(FALSE, ['is_excluido']);
        
        $log = new LogImportacao();
        $log->tipo = 'A';
        $log->empresa_nome = $model->empresa_nome;
        $log->mes = $model->mes;
        $log->ano = $model->ano;
        $log->usuario = Yii::$app->user->identity->nome;
        $log->log = "Exclusão do balancete";
        $log->save();
        
        Yii::$app->db->createCommand('UPDATE balancete_valor SET is_excluido = 1 WHERE balancete_id = ' . $model->id)->execute();
        Yii::$app->db->createCommand("UPDATE saldo_inicial SET is_excluido = 1 WHERE empresa_id = {$model->empresa_id} AND ano = {$model->ano} AND mes = {$model->mes}")->execute();

        \Yii::$app->getSession()->setFlash('success','O balancete foi removido com sucesso.');
        
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        $empresa_id = Yii::$app->user->identity->empresa_id;
        
        if (($model = Balancete::find()->andWhere(['empresa_id' => $empresa_id, 'id' => $id])->one()) !== null) 
        {
            return $model;
        } 
        else 
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
