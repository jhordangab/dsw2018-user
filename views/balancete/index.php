<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\magic\StatusBalanceteMagic;

$this->title = 'Balancetes';
$this->params['breadcrumbs'][] = $this->title;

$css = <<<CSS
        
    .badge.badge-success
    {
        background-color: #237486;
    }
        
    .badge.badge-warning
    {
        background-color: #f44336;
    }
        
CSS;

$this->registerCss($css);

$meses = 
[
    1 => 'Janeiro',
    2 => 'Fevereiro',
    3 => 'Março',
    4 => 'Abril',
    5 => 'Maio',
    6 => 'Junho',
    7 => 'Julho',
    8 => 'Agosto',
    9 => 'Setembro',
    10 => 'Outubro',
    11 => 'Novembro',
    12 => 'Dezembro'
];

$anos = [];

for($i = 2015; $i > 2022; $i++)
{
    $anos[$i] = "{$i}";
}

?>

<div class="balancete-index box">
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax' => TRUE,
        'columns' => 
        [
            [
                'attribute' => 'empresa_nome',
            ],
            [
                'attribute' => 'status',
                'filter' => StatusBalanceteMagic::$status,
                'format' => 'raw',
                'headerOptions' => ['style' => 'text-align: center;'],
                'contentOptions' => ['style' => 'text-align: center;'],
                'value' => function ($model)
                {
                    $status = StatusBalanceteMagic::getStatus($model->status);
                    $class = StatusBalanceteMagic::getClass($model->status);
                    
                    return "<span class='badge badge-{$class}' title='{$status}'>&nbsp;</span>";
                }
            ],
            [
                'attribute' => 'mes',
                'filter' => $meses,
                'value' => function ($model) use ($meses)
                {
                    return $meses[$model->mes];
                }
            ],
            [
                'attribute' => 'ano',
                'headerOptions' => ['style' => 'text-align: center;'],
                'contentOptions' => ['style' => 'text-align: center;'],
                'filter' => $anos,
            ],
            [
                'attribute' => 'created_at',
                'filter' => FALSE,
                'headerOptions' => ['style' => 'width: 15%; text-align: center;'],
                'contentOptions' => ['style' => 'text-align: center;'],
                'format' => 'raw',
                'value' => function ($model)
                {
                    return Yii::$app->formatter->asDate($model->created_at, 'd/M/Y');
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'headerOptions' => ['style' => 'width: 10%; text-align: center;'],
                'contentOptions' => ['style' => 'text-align: center;'],
                'buttons' =>
                [
                    'create' => function ($url, $model) 
                    {     
                        return Html::a('<span class="fa fa-eye"></span>', $url, [
                                'title' => Yii::t('yii', 'Visualizar'),
                        ]);                                
                    }
                ]        
            ]
        ],
    ]); ?>
    
</div>
