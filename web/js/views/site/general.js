function formatMoney(value)
{
    value = value.toString().replace(/\D/g,"");
    value = value.toString().replace(/(\d)(\d{8})$/,"$1.$2");
    value = value.toString().replace(/(\d)(\d{5})$/,"$1.$2");
    value = value.toString().replace(/(\d)(\d{2})$/,"$1,$2");
    return value                    
};

function previous(_url, _index)
{
    var _i = parseInt(_index) - 1;

    jQuery.ajax({
        url: '/site/graph',
        data: 
        {
            url: _url,
            index: _i,
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
};

function formatMoney(value)
{
    value = value.toString().replace(/\D/g,"");
    value = value.toString().replace(/(\d)(\d{8})$/,"$1.$2");
    value = value.toString().replace(/(\d)(\d{5})$/,"$1.$2");
    value = value.toString().replace(/(\d)(\d{2})$/,"$1,$2");
    return value                    
};