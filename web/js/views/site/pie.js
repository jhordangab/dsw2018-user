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

        createPie(data, _url, _index, _last);
    }
};

function createPie(data, _url, _index, _last)
{
    var _dataprovider = [];

    for(var i = 0; i < data.dataProvider.length; i++)
    {
        _dataprovider.push({"category": data.dataProvider[i][data.tituloX], "value": Math.abs(data.dataProvider[i][data.tituloY]), "color": data.dataProvider[i]['color']}); 
    }
        
    var chart = AmCharts.makeChart("rendergraph",
    {
        "alpha": 0.8,
        "type": "pie",
        "language": "pt-BR",
        "theme": "light",
        "dataProvider": _dataprovider,
        "valueField": "value",
        "colorField": "color",
        "showHandOnHover": true,
        "startDuration": 0.5,
        "titleField": "category",
        "balloon":
        {
            "fixedPosition":true
        },
        "graphs": 
        [{
            "balloonText": "[[data.tituloX]]",
            "legendValueText": "[[data.tituloX]]",
            "lineColorField": "color",
            "fillColorsField": "color",
        }],
        "balloonFunction": function(item, content) 
        {
            return '<p style="font-size: 120%; font-weight: bold; margin-bottom: 15px;"></p>\
                <table>\
                    <tr><th style="text-align: center;">' + data.tituloX + '</th></tr>\
                    <tr><td style="text-align: center;">' + item.dataContext['category'] + '</td></tr>\
                    <tr><th style="text-align: center;">' + data.tituloY + '</th></tr>\
                    <tr><td style="text-align: center;">' + item.dataContext['value'] + '</td></tr>\
                </table>';
        },
        "listeners": 
        [{
            "event": "clickSlice",
            "method": function(event) 
            {
                if(!_last)
                {
                    var _category = encodeURIComponent(encodeURIComponent(event.dataItem.title));
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
};

$(".open-painel").click(function(e) 
{
    e.preventDefault();
    $(".sidebar--painel").toggleClass("block__slide");
});