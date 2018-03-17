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
use app\magic\StatusBalanceteMagic;
use yii\helpers\Json;
use app\models\BalanceteImportForm;
use yii\web\UploadedFile;
use app\models\AdminEmpresa;
use app\models\LogImportacao;
use app\models\SaldoInicial;

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
                        'actions' => 
                        [
                            'index', 'view', 'get-views',
                            'importar-balancete', 'validar-balancete', 'excluir-balancete',
                            'inserir-valor', 'alterar-valor',
                            'inserir-saldo', 'alterar-saldo'
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) 
                        {
                            return in_array(Yii::$app->user->identity->perfil_id, ['1', '26']);
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
        $categorias = CategoriaPadrao::find()->getEmpresaTree(null, $model->empresa_id);
        $saldos = SaldoInicial::find()->andWhere(
        [
            'is_ativo' => TRUE,
            'is_excluido' => FALSE,
            'mes' => $model->mes,
            'ano' => $model->ano,
            'empresa_id' => $model->empresa_id
        ])->exists();

        return $this->render('view', [
            'model' => $model,
            'categorias' => $categorias,
            'saldos' => $saldos
        ]);
    }
    
    public function actionGetViews($id)
    {
        $model = $this->findModel($id);
        $categorias = CategoriaPadrao::find()->getEmpresaTree(null, $model->empresa_id);
        
        return Json::encode([
            'info' => $this->renderAjax('_partials/_info', compact('model')),
            'valor' => $this->renderAjax('_partials/_valor', compact('model', 'categorias')),
            'saldo' => $this->renderAjax('_partials/_saldo-inicial', compact('model', 'categorias')),
        ]);
    }
    
    public function actionImportarBalancete()
    {
        $this->layout = '//_layout_modal';
        
        $model = new BalanceteImportForm();
        
        if ($model->load(Yii::$app->request->post())) 
        {
            $model->file = UploadedFile::getInstance($model, 'file');
            $model->empresa_nome = AdminEmpresa::findOne($model->empresa_id)->nomeFantasia;
            
            if($model->validate() && $model->save())
            {
                \Yii::$app->getSession()->setFlash('success','O balancete foi importado com sucesso.');
            }
        }
        
        return $this->render('_import',
        [
            'model' => $model,
        ]);
    }
    
    public function actionValidarBalancete($id)
    {
        $this->layout = '//_layout_modal';
        $model = $this->findModel($id);
        $model->setScenario(Balancete::SCENARIO_VALIDATION);
        $model->status = StatusBalanceteMagic::STATUS_VALIDATED;
        
        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            \Yii::$app->getSession()->setFlash('success','O balancete foi validado com sucesso.');
            $this->refresh();
        }
        else 
        {
            return $this->render('_form-validate', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionExcluirBalancete($id)
    {
        $model = $this->findModel($id);
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
    
    public function actionInserirValor($balancete_id, $categoria_id)
    {
        $this->layout = '//_layout_modal';
        $model = new BalanceteValor();
        $model->balancete_id = $balancete_id;
        $model->categoria_id = $categoria_id;
        
        $categoria = CategoriaPadrao::findOne(['codigo' => $categoria_id]);
        
        if(!$categoria)
        {
            $categoria = CategoriaEmpresa::findOne(['codigo' => $categoria_id]);
            
            if(!$categoria)
            {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        }    
        
        $model->categoria_nome = $categoria->desc_codigo . ' - ' . $categoria->descricao;

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            \Yii::$app->getSession()->setFlash('success','O valor do balancete foi salvo com sucesso.');
            $this->refresh();
        }
        else 
        {
            return $this->render('_form-valor', [
                'model' => $model,
            ]);
        }
    }

    public function actionAlterarValor($id)
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
            return $this->render('_form-valor', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionInserirSaldo($balancete_id, $categoria_id)
    {
        $this->layout = '//_layout_modal';
        $model = new SaldoInicial();
        $model->categoria_id = $categoria_id;
        $balancete = Balancete::findOne($balancete_id);
        $model->empresa_id = $balancete->empresa_id;
        $model->empresa_nome = $balancete->empresa_nome;
        $model->ano = $balancete->ano;
        $model->mes = $balancete->mes;
        
        $categoria = CategoriaPadrao::findOne(['codigo' => $categoria_id]);
        
        if(!$categoria)
        {
            $categoria = CategoriaEmpresa::findOne(['codigo' => $categoria_id]);
            
            if(!$categoria)
            {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        }    
        
        $model->categoria_nome = $categoria->desc_codigo . ' - ' . $categoria->descricao;

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            \Yii::$app->getSession()->setFlash('success','O saldo inicial foi salvo com sucesso.');
            $this->refresh();
        }
        else 
        {
            return $this->render('_form-saldo', [
                'model' => $model,
            ]);
        }
    }

    public function actionAlterarSaldo($id)
    {
        $this->layout = '//_layout_modal';
        $model = SaldoInicial::findOne($id);
        $model->categoria_nome = ($model->categoria) ? $model->categoria->desc_codigo . ' - ' . $model->categoria->descricao : $model->categoria_id;

        if ($model->load(Yii::$app->request->post()) && $model->save(FALSE, ['valor'])) 
        {
            \Yii::$app->getSession()->setFlash('success','O saldo inicial foi alterado com sucesso.');
            $this->refresh();
        }
        else 
        {
            return $this->render('_form-saldo', [
                'model' => $model,
            ]);
        }
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
