<?php

use yii\helpers\Html;
use kartik\grid\GridView;

$this->title = 'Regiões';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="regiao-index box box-success">
    
    <p>
        
        <?= Html::a('<i class="fa fa-plus"></i> Cadastrar', ['create'], 
        [
            'class' => 'btn btn-success'
        ]); ?>
        
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax' => TRUE,
        'columns' => 
        [
            [
                'attribute' => 'nome_estado',
                'format' => 'raw',
                'value' => function ($model)
                {
                    return $model->nome_estado . ' (' . $model->uf . ')';
                }
            ],
            [
                'attribute' => 'regiao',
                'format' => 'raw',
                'value' => function ($model)
                {
                    return $model->regiao . ' (' . $model->sigla_regiao . ')';
                }
            ],
            'tipo_regiao',
            [
                'attribute' => 'status',
                'filter' => [1 => 'Ativo', 0 => 'Inativo'],
                'format' => 'raw',
                'headerOptions' => ['style' => 'width: 10%; text-align: center;'],
                'contentOptions' => ['style' => 'text-align: center;'],
                'value' => function ($model)
                {
                    $status = ($model->is_ativo) ? 'Clique para inativar' : 'Clique para ativar';
                    $color = ($model->is_ativo) ? 'green' : 'red';
                    $icon = ($model->is_ativo) ? 'fa fa-check' : 'fa fa-close';
                    
                    return Html::a("<i class='{$icon}' style='color:{$color}' title='{$status}'></i>", ['status', 'id' => $model->id]);
                }
            ],
            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{update} {delete}',
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
                    'delete' => function ($url, $model) 
                    {     
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $model->id], [
                            'title' => Yii::t('yii', 'Excluir'),
                            'data-confirm' => Yii::t('yii', 'Tem certeza que deseja excluir essa região?'),
                        ]);
                    }
                ]        
            ]
        ],
    ]); ?>
    
</div>
