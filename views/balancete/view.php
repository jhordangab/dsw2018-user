<?php

use yii\helpers\Html;
use app\magic\StatusBalanceteMagic;

$this->title = $model->empresa_nome . ' - ' . $model->mes . '/' . $model->ano;
$this->params['breadcrumbs'][] = ['label' => 'Balancetes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$sum = 0;

$css = <<<CSS
        
    .badge.badge-success
    {
        background-color: #237486;
    }
        
    .badge.badge-warning
    {
        background-color: #f44336;
    }
        
    table.detail-view th
    {
        width: 30%;
    }

    table.detail-view td 
    {
        width: 70%;
    }
        
    .open-children.closed
    {
        display:none;
    }
CSS;

$this->registerCss($css);

$js = <<<JS
        
    $('.modal_valid_balancete').click(function () 
    {
        var url = $(this).attr("data-link");
        var title = $(this).attr("data-title");
        $('#iframe_modal_balancete').attr('src', url);
        $("[id^='modal_balancete']").modal("show");
        $('.modal-backdrop').removeClass('modal-backdrop');
        $('#modal_balancete .modal-header h3').text(title);
    });
        
    $("[id^='modal_balancete']").on('hidden.bs.modal', function () 
    {
        jQuery.ajax({
            url: '/balancete/get-views?id=' + {$model->id},
            dataType: 'JSON',
            success: function (data) 
            {
                $('#div-balancete-info').html(data.info);
                $('#div-balancete-table').html(data.table);
            },
        });
    });
        
JS;

$this->registerJs($js);

?>

<?= $this->render('_wf_iframe_balancete') ?>

<div class="balancete-view box">

    <p>
        
        <?= Html::a('Voltar', ['index'], ['class' => 'btn btn-default']) ?>
        
        <?php if($model->status == StatusBalanceteMagic::STATUS_SENT) : ?>
        
            <?= Html::a('<i class="fa fa-check"></i> Validar', FALSE, 
            [
                'title' => 'Validar',
                'class' => 'btn btn-success modal_valid_balancete',
                'data-link' => '/balancete/validate?id=' . $model->id,
                'data-title' => 'Validação de Balancete',
                'style' => 'cursor:pointer;'
            ]); ?>
                
        <?php endif; ?>
        
    </p>
    
    <ul class="nav nav-tabs" id="baltab" role="tablist">
        
        <li class="nav-item active">
          
            <a class="nav-link active" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="true">Informações</a>
        
        </li>
        
        <li class="nav-item">
          
            <a class="nav-link" id="data-tab" data-toggle="tab" href="#data" role="tab" aria-controls="data" aria-selected="false">Dados</a>
        
        </li>
        
    </ul>
    
    <div class="tab-content" id="baltabcont">
        
        <div class="tab-pane active" id="info" role="tabpanel" aria-labelledby="info-tab" style="padding: 10px;">

            <div id="div-balancete-info">
                
                <?= $this->render('_partials/_info', compact('model')); ?>
                
            </div>            
            
        </div>
        
        <div class="tab-pane fade" id="data" role="tabpanel" aria-labelledby="profile-tab" style="padding: 10px;">
            
            <div id="div-balancete-table">
                
                <?= $this->render('_partials/_table', compact('model', 'balancetes')); ?>
                
            </div>  
            
        </div>
    
    </div>

</div>
