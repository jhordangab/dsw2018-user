<?php

use kartik\grid\GridView;

$this->title = 'Logs';
$this->params['breadcrumbs'][] = $this->title;

$css = <<<CSS
        
    .badge.badge-success
    {
        background-color: #237486;
    }
        
    .badge.badge-error
    {
        background-color: #f44336;
    }
        
    .badge.badge-warning
    {
        background-color: #f9f940;
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

for($i = 2016; $i < 2022; $i++)
{
    $anos[$i] = "{$i}";
}

?>

<div class="log-index box">
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax' => TRUE,
        'columns' => 
        [
            [
                'attribute' => 'tipo',
                'filter' => ['S' => 'Sucesso', 'E' => 'Erro', 'A' => 'Exclusão'],
                'format' => 'raw',
                'headerOptions' => ['style' => 'width:10%; text-align: center;'],
                'contentOptions' => ['style' => 'text-align: center;'],
                'value' => function ($model)
                {
                    $status = 'Erro';
                    $class = 'error';
                    
                    switch($model->tipo)
                    {
                        case 'S':
                            $status = 'Sucesso';
                            $class = 'success';
                            break;
                        case 'E':
                            $status = 'Erro';
                            $class = 'error';
                            break;
                        case 'A':
                            $status = 'Exclusão';
                            $class = 'warning';
                    }
                    
                    return "<span class='badge badge-{$class}' title='{$status}'>&nbsp;</span>";
                }
            ],
            [
                'attribute' => 'empresa_nome',
            ],
            [
                'attribute' => 'mes',
                'headerOptions' => ['style' => 'width:10%; text-align: center;'],
                'contentOptions' => ['style' => 'text-align: center;'],
                'filter' => $meses,
                'value' => function ($model) use ($meses)
                {
                    return $meses[$model->mes];
                }
            ],
            [
                'attribute' => 'ano',
                'headerOptions' => ['style' => 'width:10%; text-align: center;'],
                'contentOptions' => ['style' => 'text-align: center;'],
                'filter' => $anos,
            ],
            [
                'attribute' => 'log'
            ],
            [
                'attribute' => 'usuario'
            ],
            [
                'attribute' => 'dt_log',
                'filter' => FALSE,
                'headerOptions' => ['style' => 'width: 15%; text-align: center;'],
                'contentOptions' => ['style' => 'text-align: center;'],
                'format' => 'raw',
                'value' => function ($model)
                {
                    return Yii::$app->formatter->asDate($model->dt_log, 'd/M/Y H:mm');
                },
            ]
        ],
    ]); ?>
    
</div>
