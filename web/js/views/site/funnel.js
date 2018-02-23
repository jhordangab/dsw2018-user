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

        createFunnel(data, _url, _index, _last);
    }
};

function createFunnel(data, _url, _index, _last)
{
    var _dataprovider = [];

    for(var i = 0; i < data.dataProvider.length; i++)
    {
        _dataprovider.push({"color": data.dataProvider[i]['color'], "category": data.dataProvider[i][data.tituloX], "value": data.dataProvider[i][data.tituloY], "value2": "-" + data.dataProvider[i][data.tituloY]}); 
    }

    var chart = AmCharts.makeChart("rendergraph",
    {
        "type": "serial",
        "language": "pt-BR",
        labelsEnabled: true,
        autoMargins: true,
        marginRight: 80,
        "showHandOnHover": true,
        "dataProvider": _dataprovider,
        "valueAxes": 
        [{
            "id": "funnels",
            "position": "top",
            "labelsEnabled": true,
            "gridAlpha": 0,
            "axisAlpha": 0,
            "lineAlpha": 0.2,
            "ignoreAxisWidth": true,
            "autoWrap": true
        }],
        "startDuration": 0.5,
        "graphs": 
        [{
            "id": "fromGraph",
            "lineAlpha": 0,
            "showBalloon": false,
            "valueField": "value2",
            "fillAlphas": 0
        }, {
            "fillAlphas": 0.6,
            "fillToGraph": "fromGraph",
            "lineAlpha": 0,
            "lineColorField": "color",
            "fillColorsField": "color",
            "showBalloon": true,
            "valueField": "value",
            "balloonText": "<b>[[category]]: [[value]]</b>"
        }],
        "chartCursor": 
        {
            "categoryBalloonEnabled": false,
            "balloonPointerOrientation": "vertical",
            "cursorAlpha": 1,
            "zoomable": false
        },
        "colorField": "color",
        "categoryField": "category",
        "categoryAxis": 
        {
            "startOnAxis": true,
            "axisAlpha": 0.1,
            "gridPosition": "left",
            "gridAlpha": 0.1,
            "tickLength": 20,
            "tickPosition": "start",
            "showLastLabel": false
        },
        "listeners": 
        [{
            "event": "clickGraphItem",
            "method": function(event) 
            {
                if(!_last)
                {
                    var _category = encodeURIComponent(encodeURIComponent(event.item.category));
                    var _i = parseInt(_index) + 1;

                    jQuery.ajax({
                        url: '/site/graph',
                        data: 
                        {
                            url: _url,
                            index: _i,
                            filter: _category
                        },
                        success: function (data) 
                        {
                            $('#chartbp1').html(data);
                        },
                        beforeSend: function ()
                        {
                            $('.div-loading').addClass("loading");
                        },
                        complete: function () 
                        {
                            setTimeout(function() { $('.div-loading').removeClass("loading");}, 300);
                        }
                    });
                }
            }
        }],
        "responsive": 
        {
            "enabled": true
        }
    });

    $('.amcharts-chart-div a').remove();
}

$(".open-painel").click(function(e) 
{
    e.preventDefault();
    $(".sidebar--painel").toggleClass("block__slide");
});