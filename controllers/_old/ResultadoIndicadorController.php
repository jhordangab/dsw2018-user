<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\AdminEmpresa;
use app\magic\IndicadorBiMagic;
use app\models\Indicador;
use app\models\ResultadoIndicador;

class ResultadoIndicadorController extends Controller
{
    public $bodyClass = 'skin-blue sidebar-mini sidebar-collapse';
    
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
                            'index', 'view', 'configurar'
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
        $empresas = AdminEmpresa::find()->andWhere('id not in (1, 2)')->orderBy('nomeResumo ASC')->all();
        $indicador = Indicador::findOne(1);
        return $this->render('index', compact('empresas', 'indicador'));
    }
    
    public function actionView($empresa_id, $ano)
    {
        $empresa = AdminEmpresa::findOne($empresa_id);
        $dados = IndicadorBiMagic::getDados($empresa->nomeResumo, $ano);
        $dre = IndicadorBiMagic::getDre($empresa->nomeResumo, $ano);
        $indicador = Indicador::findOne(1);
        $configuracao = ResultadoIndicador::find()->andWhere([
            'empresa_id' => $empresa_id,
            'ano' => $ano,
            'is_ativo' => 1,
            'is_excluido' => 0
        ])->one();
        
        return $this->render('view', [
            'empresa' => $empresa,
            'ano' => $ano,
            'dados' => $dados,
            'dre' => $dre,
            'indicador' => $indicador,
            'configuracao' => $configuracao
        ]);
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
