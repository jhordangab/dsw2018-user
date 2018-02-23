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

        createLine(data, _url, _index, _last);
    }
};

function createLine(data, _url, _index, _last)
{
    var _dataprovider = [];

    for(var i = 0; i < data.dataProvider.length; i++)
    {
        _dataprovider.push({"category": data.dataProvider[i][data.tituloX], "value": data.dataProvider[i][data.tituloY], "color": data.dataProvider[i]['color']}); 
    }

    var chart = AmCharts.makeChart("rendergraph",
    {
        "type": "serial",
        "theme": "light",
        "marginRight": 30,
        "marginLeft": 80,
        "autoMarginOffset": 20,
        "mouseWheelZoomEnabled":true,
        "showHandOnHover": true,   
        "startDuration": 0.5,
        "valueAxes": 
        [{
            "id": "v1",
            "axisAlpha": 0,
            "position": "left",
            "ignoreAxisWidth": true,
            "autoWrap": true
        }],
        "categoryAxis": 
        {
            "autoWrap": true, 
        },
        "balloon": 
        {
            "borderThickness": 1,
            "shadowAlpha": 0
        },
        "graphs": 
        [{
            "id": "g1",
            "balloon":
            {
                "drop":true,
                "adjustBorderColor":false,
                "color":"#ffffff"
            },
            "fillAlphas": 0.2,
            "bullet": "round",
            "bulletBorderAlpha": 1,
            "fillColorsField": "color",
            "lineColorField": "color",
            "bulletSize": 5,
            "hideBulletsCount": 50,
            "lineThickness": 2,
            "title": "red line",
            "useLineColorForBulletBorder": true,
            "valueField": "value",
            "balloonText": "<b>" + data.tituloY + ": [[value]]</b>"
        }],
        "chartScrollbar": 
        {
            "graph": "g1",
            "oppositeAxis":false,
            "offset":30,
            "scrollbarHeight": 80,
            "backgroundAlpha": 0,
            "selectedBackgroundAlpha": 0.1,
            "selectedBackgroundColor": "#888888",
            "graphFillAlpha": 0,
            "graphLineAlpha": 0.5,
            "selectedGraphFillAlpha": 0,
            "selectedGraphLineAlpha": 1,
            "autoGridCount":true,
            "color":"#AAAAAA"
        },
        "chartCursor": 
        {
            "pan": true,
            "valueLineEnabled": true,
            "valueLineBalloonEnabled": true,
            "cursorAlpha":1,
            "cursorColor":"#258cbb",
            "limitToGraph":"g1",
            "valueLineAlpha":0.2,
            "valueZoomable":true
        },
        "valueScrollbar":
        {
            "oppositeAxis":false,
            "offset":50,
            "scrollbarHeight":10
        },
        "categoryField": "category",
        "colorField": "color",
        "dataProvider": _dataprovider,
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

    chart.addListener("rendered", zoomChart);

    zoomChart();

    function zoomChart() 
    {
        chart.zoomToIndexes(chart.dataProvider.length - 40, chart.dataProvider.length - 1);
    }

    $('.amcharts-chart-div a').remove();
}

$(".open-painel").click(function(e) 
{
    e.preventDefault();
    $(".sidebar--painel").toggleClass("block__slide");
});