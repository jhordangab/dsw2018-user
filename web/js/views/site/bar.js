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

        createBar(data, _url, _index, _last);
    }
};

function createBar(data, _url, _index, _last)
{
    var chart = AmCharts.makeChart("rendergraph", 
    {
        "type": "serial",
        "language": "pt-BR",
        "theme": "light",
        "colorField": "color",
        "categoryField": data.tituloX,
        "language": "pt-BR",
        "valueField": data.tituloY,
        "titleField": data.tituloX,
        "rotate": true,
        "startDuration": 0.5,
        "trendLines": [],
        "showHandOnHover": true,
        "graphs": 
        [
            {
                "balloonText": data.tituloY + ": [[value]]",
                "fillAlphas": 0.5,
                "id": "AmGraph-1",
                "lineAlpha": 0.2,
                "title": data.tituloY,
                "type": "column",
                "valueField": data.tituloY,
                "lineColorField": "color",
                "fillColorsField": "color",
            },
        ],
        "guides": [],
        "valueAxes": 
        [
            {
                "id": "ValueAxis-1",
                "position": "top",
                "axisAlpha": 0,
                "lineAlpha": 0.2,
                "ignoreAxisWidth": true,
                "autoWrap": true
            }
        ],
        "allLabels": [],
        "balloon":
        {
            "fixedPosition":true
        },
        "titles": [],
        "dataProvider": data.dataProvider,
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