<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\AdminEmpresa;
use app\magic\OutraDespesaBiMagic;
use app\models\Indicador;

class ResultadoOutraDespesaController extends Controller
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
                            'index', 'view'
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
        $indicador = Indicador::findOne(5);
        return $this->render('index', compact('empresas', 'indicador'));
    }
    
    public function actionView($empresa_id, $ano)
    {
        $empresa = AdminEmpresa::findOne($empresa_id);
        $dados = OutraDespesaBiMagic::get($empresa->nomeResumo, $ano);
        $indicador = Indicador::findOne(5);

        return $this->render('view', [
            'empresa' => $empresa,
            'ano' => $ano,
            'dados' => $dados,
            'indicador' => $indicador
        ]);
    }
}