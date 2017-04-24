/**
 * Created by admin on 18.04.17.
 */
$(document).ready(function(){

    function scroller()
    {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $('.scrollup').fadeIn();
            } else {
                $('.scrollup').fadeOut();
            }
        });

        $('.scrollup').click(function () {
            $("html, body").animate({scrollTop: 0}, 600);
            return false;
        });
    }

    function startMenu()
    {
        $('li[id ^= s1]').hover(function () {
            $('.trends').toggleClass('show')
        });
        $('li[id ^= s2]').hover(function () {
            $('.real').toggleClass('show')
        });
    }

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

    scroller();
    startMenu();
    setCountBasket();
    buyer();
    ranjer();



});