<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\AdminEmpresa;
use app\magic\BalanceteBiMagic;
use app\models\Indicador;
use kartik\mpdf\Pdf;

class ResultadoBalanceteController extends Controller
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
                            'index', 'view', 'report'
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
        $indicador = Indicador::findOne(14);
        return $this->render('index', compact('empresas', 'indicador'));
    }
    
    public function actionView($empresa_id, $ano)
    {
        $empresa = AdminEmpresa::findOne($empresa_id);
        $dados = BalanceteBiMagic::get($empresa->nomeResumo, $ano);
        $indicador = Indicador::findOne(14);

        return $this->render('view', [
            'empresa' => $empresa,
            'ano' => $ano,
            'dados' => $dados,
            'indicador' => $indicador
        ]);
    }
    
    public function actionReport($empresa_id, $ano)
    {
        ini_set('memory_limit', '128M');
        setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
	date_default_timezone_set('America/Sao_Paulo');
        
        $empresa = AdminEmpresa::findOne($empresa_id);
        $dados = BalanceteBiMagic::get($empresa->nomeResumo, $ano);
        $content = $this->renderPartial('_partials/_table-pdf', compact('dados', 'empresa', 'ano'));
        $title = 'Balancetes:: ' . $empresa->razaoSocial . ' / ' . $ano;
        $date = ucwords(strftime('%A, %d', strtotime('today'))) . ' de ' .
                ucwords(strftime('%B', strtotime('today'))) . ' de ' .
                ucwords(strftime('%Y', strtotime('today')));
        
        $pdf = new Pdf([
            'mode' => Pdf::MODE_CORE, 
            'format' => Pdf::FORMAT_A4, 
            'orientation' => Pdf::ORIENT_PORTRAIT, 
            'destination' => Pdf::DEST_BROWSER, 
            'filename' => $title . '.pdf',
            'content' => $content,  
            'cssFile' => '',
            'cssInline' => '', 
            'options' => ['title' => $title],
            'marginLeft' => 5,
            'marginRight' => 5,
            'methods' => 
            [
                'SetHeader' => ['BP1 Sistemas||' . $date],
                'SetFooter' => ['|Página {PAGENO}|'],
            ]
        ]);

        return $pdf->render();
    }
}
