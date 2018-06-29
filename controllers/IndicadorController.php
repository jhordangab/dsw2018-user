<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\AdminEmpresa;
use app\magic\IndicadorBiMagic;
use app\models\ResultadoIndicador;
use app\models\forms\IndicadorForm;

class IndicadorController extends Controller
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
                        'actions' => 
                        [
                            'index', 'get-data', 'configurar'
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
        $model = new IndicadorForm();
//        default values
        $model->ano = (int) date("Y") - 1;
        
        $empresas = AdminEmpresa::find()->andWhere('id not in (1, 2)')->orderBy('nomeResumo ASC')->all();
        
        return $this->render('index', compact('model', 'empresas'));
    }
    
    public function actionGetData()
    {
        $this->layout = FALSE;
        $model = new IndicadorForm();
        
        if ($model->load(Yii::$app->request->post()))
        {
            $dados = IndicadorBiMagic::getDados($model);
            $dre = IndicadorBiMagic::getDre($model);
            $provisao = IndicadorBiMagic::getProvisao($model);
            $configuracao = ResultadoIndicador::find()->andWhere([
                'empresa_id' => $model->empresa_id,
                'ano' => $model->ano,
                'is_ativo' => 1,
                'is_excluido' => 0
            ])->one();

            return $this->renderAjax('_partials/_data', compact('model', 'dados', 'dre', 'configuracao', 'provisao'));
        }
        
        return '';
    }
    
    public function actionConfigurar($empresa_id, $ano)
    {
        $this->layout = '//_layout_modal';
        
        $model = ResultadoIndicador::find()->andWhere([
            'empresa_id' => $empresa_id,
            'ano' => $ano,
            'is_ativo' => 1,
            'is_excluido' => 0
        ])->one();
        
        if(!$model)
        {
            $model = new ResultadoIndicador();
            $model->empresa_id = $empresa_id;
            $model->ano = $ano;
        }
        
        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            \Yii::$app->getSession()->setFlash('success','O indicador foi configurado com sucesso.');
            $this->refresh();
        }
        else 
        {
            return $this->render('_form-conf', [
                'model' => $model,
            ]);
        }
    }
}
