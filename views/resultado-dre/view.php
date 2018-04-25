<?php

use yii\bootstrap\Modal;
use kartik\helpers\Html;

$this->title = 'DREs:: ' . $empresa->razaoSocial . ' / ' . $ano;
        
$this->params['breadcrumbs'][] = ['label' => 'DREs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$h_img = fopen('img/logo.png', "rb");
$img = fread($h_img, filesize('img/logo.png'));
fclose($h_img);

$pic = 'data://image/png;base64,' . base64_encode($img);
$date = ucwords(strftime('%A, %d', strtotime('today'))) . ' de ' .
                ucwords(strftime('%B', strtotime('today'))) . ' de ' .
                ucwords(strftime('%Y', strtotime('today')));
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
                    "position": "left",
                    "axisAlpha": 0,
                    "lineAlpha": 0.2
                }
            ],
            "allLabels": [],
            "balloon":
            {
                "fixedPosition":true
            },
            "titles": 
            [
                {
                    "text": data.descricao,
                    "bold": false
                }
            ],
            "dataProvider": _dataprovider,
            "responsive": 
            {
                "enabled": true
            },
            "export":
            {
                "enabled": true,
                "menu": []
            }
        });
    }
        
    $('.body-valor tr.graph').click(function () 
    {
        var _data = $(this).data('json');
        $("[id^='modal_balancete']").modal("show");
        $('.modal-backdrop').removeClass('modal-backdrop');
        $('#modal_balancete .modal-header h3').text(_data.descricao);
        
        createBar(_data);
    });
        
    $("button.exportgraph2pdf").click(function()
    {
        var ids = ["rendergraph"];

        var charts = {},
        charts_remaining = ids.length;
        for (var i = 0; i < ids.length; i++) 
        {
            for (var x = 0; x < AmCharts.charts.length; x++) 
            {
                if (AmCharts.charts[x].div.id == ids[i])
                charts[ids[i]] = AmCharts.charts[x];
            }
        }

        for (var x in charts) 
        {
            if (charts.hasOwnProperty(x)) 
            {
                var chart = charts[x];
                chart["export"].capture({}, function()
                {
                    this.toJPG({}, function(data) 
                    {
                        this.setup.chart.exportedImage = data;

                        charts_remaining--;

                        if (charts_remaining == 0)
                        {
                            generatePDF();
                        }
                    });
                });
            }
        }

        function generatePDF() 
        {
            var layout =
            {
                "content": [],
                pageSize: 'A4',
                pageMargins: [ 40, 60, 40, 60 ],
                images: 
                {
                    logo: "$pic"
                },
                styles: 
                {
                    headerTitle: 
                    {
                        fontSize: 8,
                        alignment: 'left'
                    },
                    headerDate: 
                    {
                        fontSize: 8,
                        alignment: 'right'
                    },
                },
                header: 
                {
                    columns: 
                    [
                        {
                            "text": "BP1 Sistemas",
                            "fontSize": 8,
                            "margin": [ 45, 20, 20, 20 ],
                            "style": ['headerTitle']
                        }, 
                        {
                            "text": "$date",
                            "fontSize": 8, 
                            "margin": [ 20, 20, 45, 20 ],
                            "style": ['headerDate']
                        }
                    ]
                },
            };
        
            layout.content.push({
                "columns": 
                [
                    {
                        "width": "30%",
                        "image": "logo",
                        "fit": [150, 150]
                    }, 
                    {
                        "width": "*",
                        "stack": 
                        [
                            " ",
                            " ",    
                            "DRE",
                            "Empresa: $empresa->razaoSocial",
                            "Exercício Fiscal: $ano"
                        ]
                    }
                ],
                "columnGap": 10
            });
        
            layout.content.push({
                "image": charts["rendergraph"].exportedImage,
                "fit": [523, 300],
                "margin": [ 0, 100, 0, 0 ],
            });

            chart["export"].toPDF(layout, function(data) 
            {
                this.download(data, "application/pdf", "$this->title.pdf");
            });
        }
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

<button class="btn btn-xs btn-success pull-right exportgraph2pdf" style="color: #FFF; cursor: pointer;" title="Exportar para PDF"><i class='fa fa-file-pdf-o'></i></button>

<div id="rendergraph" class="chart-box h-100" style="height: 500px; overflow: hidden; text-align: left; margin-top: 20px;"></div>

<?php Modal::end(); ?>

<h2 class="page-header">
    <i class="fa fa-calculator"></i> <?= $this->title ?>
    <small class="pull-right">Última Atualização: <?= ($indicador) ? Yii::$app->formatter->asDate($indicador->dthr_atualizacao, 'd/M/Y H:mm') : '' ?> </small>
</h2>

<?= Html::a('<i class="fa fa-arrow-left"></i>',['index'], ['class' => 'btn btn-xs btn-default pull-left', 'style' => 'margin-bottom: 10px;', 'title' => 'Clique para voltar']) ?>

<?= Html::a('<i class="fa fa-file-pdf-o"></i>',['report',  'empresa_id' => $empresa->id, 'ano' => $ano], ['target' => '_blank', 'class' => 'btn btn-xs btn-success pull-right', 'style' => 'margin-bottom: 10px; margin-left: 5px;', 'title' => 'Clique para exportar para PDF']) ?>

<div class="row" style="padding: 10px;">
    <?= $this->render('_partials/_table', compact('dados')); ?>
</div>
