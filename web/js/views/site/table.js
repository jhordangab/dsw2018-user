function selectEl(_val, _index, _url)
{
    var _category = encodeURIComponent(encodeURIComponent(_val));
    
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
};

$(".open-painel").click(function(e) 
{
    e.preventDefault();
    $(".sidebar--painel").toggleClass("block__slide");
});