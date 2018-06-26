<?php

use yii\helpers\Html;
use kartik\grid\GridView;

$this->title = 'Empresas';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="empresa-index box box-success">
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax' => TRUE,
        'columns' => 
        [
            'nomeResumo',
            'razaoSocial',
            [
                'attribute' => 'regiao',
                'value' => function($model)
                {
                    return ($model->dado) ? $model->dado->regiao->nome_estado . ' (' . 
                            $model->dado->regiao->uf . ')' : '';
                }
            ],
            [
                'attribute' => 'unidade',
                'value' => function($model)
                {
                    return ($model->dado) ? $model->dado->unidade : '';
                }
            ],
            [
                'attribute' => 'faixa_faturamento',
                'value' => function($model)
                {
                    return ($model->dado) ? $model->dado->faixaFaturamento->nome : '';
                }
            ],
            [
                'attribute' => 'bandeira',
                'value' => function($model)
                {
                    return ($model->dado) ? $model->dado->bandeira->nome : '';
                }
            ],
            [
                'attribute' => 'segmento',
                'value' => function($model)
                {
                    return ($model->dado) ? $model->dado->segmento->nome : '';
                }
            ],
            [
                'attribute' => 'status',
                'filter' => ['Ativo' => 'Ativo', 'Inativo' => 'Inativo'],
                'format' => 'raw',
                'headerOptions' => ['style' => 'width: 10%; text-align: center;'],
                'contentOptions' => ['style' => 'text-align: center;'],
                'value' => function ($model)
                {
                    $status = ($model->status == 'Ativo') ? 'Ativo' : 'Inativo';
                    $color = ($model->status == 'Ativo') ? 'green' : 'red';
                    $icon = ($model->status == 'Ativo') ? 'fa fa-check' : 'fa fa-close';
                    
                    return "<i class='{$icon}' style='color:{$color}' title='{$status}'></i>";
                }
            ],
            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{update}',
                'headerOptions' => ['style' => 'width: 10%; text-align: center;'],
                'contentOptions' => ['style' => 'text-align: center;'],
                'buttons' =>
                [
                    'update' => function ($url, $model) 
                    {     
                        return Html::a('<span class="fa fa-edit"></span>', $url, [
                            'title' => Yii::t('yii', 'Alterar'),
                        ]);                                
                    },
                ]        
            ]
        ],
    ]); ?>
    
</div>