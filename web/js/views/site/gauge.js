function init(data, _index, _url, _last)
{
    $('#title-graph').html('BP1 BI - Consulta:: ' + data.titulo);
        
    if(data)
    {
        jQuery.ajax({
            url: '/site/filter',
            type: 'POST',
            data: 
            {
                'json': JSON.stringify(data), 
                'url': _url
            },
            success: function (data) 
            {
                $('.sidebar--painel #filtro').html(data);
            }
        });

        createGauge(data, _url, _index, _last);
    }
};

function createGauge(data, _url, _index, _last)
{
    if(data.dataProvider.length == 1)
    {
        createSimpleGauge(data, _url, _index, _last);
    }
    else if(data.dataProvider.length < 5)
    {
        createCompletedGauge(data, _url, _index, _last);
    }
    else
    {
        iziToast.error({
            title: 'Ops!',
            message: 'Esse gráfico não suporta mais que 4 opções.',
            position: 'topCenter',
            close: true,
            transitionIn: 'flipInX',
            transitionOut: 'flipOutX',
        });
    }
    
    $('.amcharts-chart-div a').remove();
}

function createCompletedGauge(data, _url, _index, _last)
{
    var _dataprovider = [];
    var _labels = [];
    var _bands = [];
    var _sum = 0;

    for(var i = 0; i < data.dataProvider.length; i++)
    {
        _sum += parseInt(data.dataProvider[i][data.tituloY]);
    }

    for(var i = 0; i < data.dataProvider.length; i++)
    {
        var _cm = Math.round((parseInt(data.dataProvider[i][data.tituloY]) * 100) / _sum);
        var _color = data.dataProvider[i]["color"];

        _bands.push({
            "color": "#eee",
            "startValue": 0,
            "endValue": 100,
            "radius": 40 + (20 * i) + "%",
            "innerRadius": 25 + (20 * i) + "%",
        }); 

        _bands.push({
            "color": _color,
            "startValue": 0,
            "endValue": _cm,
            "radius": 40 + (20 * i) + "%",
            "innerRadius": 25 + (20 * i) + "%",
            "balloonText": _cm + "%",
        }); 

        _labels.push({
            "text": data.dataProvider[i][data.tituloX],
            "x": "49%",
            "y": 33 - (i * 10) - i + "%",
            "size": 15,
            "bold": true,
            "color": _color,
            "align": "right",
        }); 
    }

    var gaugeChart = AmCharts.makeChart("rendergraph",
    {
        "type": "gauge",
        "theme": "light",
        "axes": 
        [{
            "axisAlpha": 0,
            "tickAlpha": 0,
            "labelsEnabled": false,
            "startValue": 0,
            "endValue": 100,
            "startAngle": 0,
            "endAngle": 270,
            "bands": _bands
        }],
        "allLabels": _labels,
        "export": 
        {
            "enabled": true
        }
    });
};

function createSimpleGauge(data, _url, _index, _last)
{
    var _val = data.dataProvider[0][data['tituloY']];
    var _cos = (_val > 100) ? 100 : _val;
    var chart = AmCharts.makeChart("rendergraph", 
    {
        "alpha": 0.8,
        "theme": "light",
        "type": "gauge",
        "axes": 
        [{
            "topTextFontSize": 20,
            "topTextYOffset": 70,
            "axisColor": "#31d6ea",
            "axisThickness": 1,
            "endValue": 100,
            "gridInside": true,
            "inside": true,
            "radius": "50%",
            "valueInterval": 10,
            "tickColor": "#67b7dc",
            "startAngle": -90,
            "endAngle": 90,
            "unit": "%",
            "bandOutlineAlpha": 0,
            "bottomText": data['tituloY'] + ': ' + _val + '%',
            "bands":
            [
                {
                    "color": "#f6453d",
                    "startValue": 0,
                    "endValue": 25,
                    "innerRadius": "105%",
                    "radius": "170%",
                    "gradientRatio": [0.5, 0, -0.5],
                }, 
                {
                    "color": "#fdd331",
                    "startValue": 25,
                    "endValue": 75,
                    "innerRadius": "105%",
                    "radius": "170%",
                    "gradientRatio": [0.5, 0, -0.5],
                }, 
                {
                    "color": "#59961d",
                    "startValue": 75,
                    "endValue": 100,
                    "innerRadius": "105%",
                    "radius": "170%",
                    "gradientRatio": [0.5, 0, -0.5]
                }
            ]
        }],
        "arrows": 
        [{
            "radius": 150,
            "nailRadius": 5,
            "startWidth": 10,
            "innerRadius": 10,
            "value": _cos
        }],
    });
}

$(".open-painel").click(function(e) 
{
    e.preventDefault();
    $(".sidebar--painel").toggleClass("block__slide");
});