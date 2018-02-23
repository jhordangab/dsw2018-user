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

        createColumn(data, _url, _index, _last);
    }
};

function createColumn(data, _url, _index, _last)
{
    var chart = AmCharts.makeChart("rendergraph",
    {
        "alpha": 0.8,
        "type": "serial",
        "language": "pt-BR",
        "theme": "light",
        "dataProvider": data.dataProvider,
        "startDuration": 0.5,
        "gridAboveGraphs": true,
        "graphs": [{
            "balloonText": data.tituloY + ": [[value]]",
            "fillAlphas": 0.5,
            "id": "AmGraph-1",
            "lineAlpha": 0.2,
            "type": "column",
            "valueField": data.tituloY,
            "lineColorField": "color",
            "fillColorsField": "color"
        }],
        "categoryField": data.tituloX,
        "colorField": "color",
        "categoryAxis": 
        {
            "gridPosition": "start",
            "axisAlpha": 0,
            "tickLength": 0,
            "ignoreAxisWidth": true,
            "autoWrap": true
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