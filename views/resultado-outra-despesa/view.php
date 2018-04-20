<?php

use yii\bootstrap\Modal;

$this->title = 'Outras Despesas:: ' . $empresa->razaoSocial . ' / ' . $ano;
        
$this->params['breadcrumbs'][] = ['label' => 'Outras Despesas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$js = <<<JS

    function createBar(data)
    {
        var _dataprovider = [];
        
        _dataprovider.push({"month": "Jan", "value": parseFloat(data['jan']).toFixed(2), "color": '#237486'}); 
        _dataprovider.push({"month": "Fev", "value": parseFloat(data['feb']).toFixed(2), "color": '#237486'}); 
        _dataprovider.push({"month": "Mar", "value": parseFloat(data['mar']).toFixed(2), "color": '#237486'});  
        _dataprovider.push({"month": "Abr", "value": parseFloat(data['apr']).toFixed(2), "color": '#237486'}); 
        _dataprovider.push({"month": "Mai", "value": parseFloat(data['may']).toFixed(2), "color": '#237486'}); 
        _dataprovider.push({"month": "Jun", "value": parseFloat(data['jun']).toFixed(2), "color": '#237486'}); 
        _dataprovider.push({"month": "Jul", "value": parseFloat(data['jul']).toFixed(2), "color": '#237486'}); 
        _dataprovider.push({"month": "Ago", "value": parseFloat(data['aug']).toFixed(2), "color": '#237486'}); 
        _dataprovider.push({"month": "Set", "value": parseFloat(data['sep']).toFixed(2), "color": '#237486'}); 
        _dataprovider.push({"month": "Out", "value": parseFloat(data['oct']).toFixed(2), "color": '#237486'}); 
        _dataprovider.push({"month": "Nov", "value": parseFloat(data['nov']).toFixed(2), "color": '#237486'});  
        _dataprovider.push({"month": "Dez", "value": parseFloat(data['dez']).toFixed(2), "color": '#237486'}); 
                   
        var chart = AmCharts.makeChart("rendergraph",
        {
            "hideCredits":true,
            "type": "serial",
            "language": "pt-BR",
            "theme": "light",
            "colorField": "color",
            "categoryField": "month",
            "valueField": "value",
            "startDuration": 0.5,
            "trendLines": [],
            "showHandOnHover": true,
            "graphs": [
                {
                    "id": "graph1",
                    "balloonText": "[[category]]: R$[[value]]",
                    "fillAlphas": 0.5,
                    "lineAlpha": 0.2,
                    "type": "column",
                    "valueField": "value",
                    "lineColorField": "color",
                    "fillColorsField": "color"
                }
            ],
            "guides": [],
            "valueAxes": 
            [
                {
                    "id": "ValueAxis-1",
                    "position": "top",
                    "axisAlpha": 0,
                    "lineAlpha": 0.2
                }
            ],
            "allLabels": [],
            "balloon":
            {
                "fixedPosition":true
            },
            "titles": [],
            "dataProvider": _dataprovider,
            "responsive": 
            {
                "enabled": true
            }
        });
        
        $('.amcharts-chart-div a').remove();
    }
        
    $('.body-valor tr.graph').click(function () 
    {
        var _data = $(this).data('json');
        $("[id^='modal_balancete']").modal("show");
        $('.modal-backdrop').removeClass('modal-backdrop');
        $('#modal_balancete .modal-header h3').text(_data.codigo + ' - ' + _data.descricao);
        
        createBar(_data);
    });

JS;

$this->registerJs($js);
        
?>

<?php

Modal::begin([
    'id' => 'modal_balancete',
    'header' => "<h3>Resultado</h3>",
    'size'=>'modal-lg',
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => false] 
]);
?>

<div id="rendergraph" class="chart-box h-100" style="height: 500px; overflow: hidden; text-align: left;"></div>

<?php Modal::end(); ?>

<h2 class="page-header">
    <i class="fa fa-calculator"></i> <?= $this->title ?>
    <small class="pull-right">Última Atualização: <?= ($indicador) ? Yii::$app->formatter->asDate($indicador->dthr_atualizacao, 'd/M/Y H:mm') : '' ?> </small>
</h2>

<div class="row" style="padding: 10px;">
    <?= $this->render('_partials/_table', compact('dados')); ?>
</div>
