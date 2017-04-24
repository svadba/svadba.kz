/**
 * Created by admin on 18.04.17.
 */
$(document).ready(function(){


    function ranjer()
    {
        $( "#slider-range" ).slider(
        {
            range: true,
            min: 1,
            max: 10000000,
            values: [ 75, 5000000 ],
            slide: function( event, ui )
                {
                    $( "#amount" ).val( "" + ui.values[ 0 ] + " - " + ui.values[ 1 ] + "т" );
                }
        });

        $( "#amount" ).val( "" + $( "#slider-range" ).slider( "values", 0 ) +
            " - " + $( "#slider-range" ).slider( "values", 1 ) + "т" );
    }

    function like_svadba()
    {
        $('#sv_like').on('click', function(){
            $.ajax({
                url: "/like_svadba",
                type: "get",
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },

                success:function(data){
                    $('#sv_l').html(data);
                },
                error:function(a,b){
                    alert('Сервер не отвечает попробуйте позже!')
                }
            });
        });
    }

    // возвращает cookie с именем name, если есть, если нет, то undefined
    function getCookie(name)
    {
        var matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }

    //устанавливает куку
    function setCookie(name, value, date)
    {
        document.cookie = name + "=" + value + "; path=/; expires=" + date;
    }

    //добавляет значение к куке
    function addCookie(name, lastValue, value, date)
    {
        document.cookie = name + "=" + lastValue + "," + value +"; path=/; expires=" + date;
    }

    //устанавливает в шапке количество объявленимй в корзине
    function setCountBasket ()
    {
        var basket = getCookie('basket');
        if(basket)
        {
            var splitbasket = basket.split(',');
            $('#count_basket').html(splitbasket.length);
        }
        else
        {
            $('#count_basket').html('0');
        }
    }


    function buyer()
    {
        $('.buy-btn').on('click', function () {

            var date = new Date;
            date.setDate(date.getDate() + 3);
            date = date.toUTCString();

            var id = $(this).attr('id');

            basket = getCookie('basket');

            if(basket)
            {
                var splitBasket = basket.split(',');

                if(splitBasket.length == 0)
                {
                    setCookie('basket', id, date);
                }
                else
                {
                    var flag = false;
                    for(var i=0; i<splitBasket.length; i++)
                    {
                        if(splitBasket[i] == id) {flag = true;}
                    }
                    if(!flag)
                    {
                        addCookie('basket', basket, id, date);
                    }
                }
            }
            else
            {
                setCookie('basket', id, date);
            }

            setCountBasket();

        });
    }

    like_svadba();
    setCountBasket();
    buyer();
    //ranjer();



});