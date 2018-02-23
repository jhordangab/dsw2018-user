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

        createMap(data, _url, _index, _last);
    }
};

function createMap(data, _url, _index, _last)
{
    var _dataprovider = [];

    for(var i = 0; i < data.dataProvider.length; i++)
    {
        _dataprovider.push({"color": data.dataProvider[i]['color'], "state": data.dataProvider[i][data.tituloX], "value": data.dataProvider[i][data.tituloY]}); 
    }

    var map = AmCharts.makeChart("rendergraph",
    {
        "type": "map",
        "theme": "light",
        "dataProvider": 
        {
            "mapURL": "/images/brazilLow.svg",
            "getAreasFromMap": true,
            "areas": []
        },
        "areasSettings": 
        {
            "alpha": 0.8,
            "autoZoom": false,
            "selectable": true,
            "balloonText": "[[title]]: <strong>[[value]]</strong>"
        },
        "titles": [{"text": "Brasil"}],
        "listeners": 
        [
            {
                "event": "init",
                "method": function(event) 
                {
                    var map = event.chart;

                    if (map.dataGenerated)
                        return;

                    if (map.dataProvider.areas.length === 0) 
                    {
                        setTimeout(updateHeatmap, 100);
                        return;
                    }

                    for (var i = 0; i < map.dataProvider.areas.length; i++)
                    {
                        var _result = $.grep(_dataprovider, function(e){ return "BR-" + e.state == map.dataProvider.areas[i].id; });

                        if (_result.length == 1) 
                        {
                            map.dataProvider.areas[i].color = _result[0].color;
                            map.dataProvider.areas[i].mouseEnabled = true;
                            map.dataProvider.areas[i].value = _result[0].value;
                        }
                        else
                        {
                            map.dataProvider.areas[i].color = "#cecece";
                            map.dataProvider.areas[i].mouseEnabled = false;
                            map.dataProvider.areas[i].value = 0;
                        }
                    }

                    map.dataGenerated = true;
                    map.validateNow();
                }
            },
            {
                "event": "clickMapObject",
                "method": function(event) 
                {
                    if(!_last)
                    {
                        var _category = event.mapObject.id.substring(3);
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
            }
        ]
    });

    $('.amcharts-chart-div a').remove();
};

$(".open-painel").click(function(e) 
{
    e.preventDefault();
    $(".sidebar--painel").toggleClass("block__slide");
});