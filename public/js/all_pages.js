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

    function deleteFromBasket()
    {
        $('.del_from_bask').on('click', function()
        {
            basket = getCookie('basket');
            if(basket)
            {
                var id = $(this).attr('id');
                var splitBasket = basket.split(',');
                if(splitBasket.length)
                {
                    console.log('split_baskt_do_foeach = ' + splitBasket);
                    splitBasket.forEach(function(item, i){
                        if(item == id)
                        {
                            splitBasket.splice(i,1);
                        }
                    });
                    console.log('split_bask_posle = ' + splitBasket);
                    var new_bask = splitBasket.join(',');
                    console.log('new_bask2_join=' + new_bask);
                    var date = new Date;
                    date.setDate(date.getDate() + 3);
                    date = date.toUTCString();
                    console.log('basket_kuka_do=' + basket);
                    setCookie('basket', new_bask, date);
                    console.log('basket_kuka_posle=' + getCookie('basket'));
                    setCountBasket();
                    $('#bask_' + id).remove();
                    console.log('endd');
                }
            }
        });
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

    function special_cards_hover() {
       $('.special.cards .image').dimmer({
          on: 'hover'
      });
   }

   function lightbox_options() {
    lightbox.option({
        'albumLabel': "%1 из %2",
        'alwaysShowNavOnTouchDevices': true
    })
}

like_svadba();
setCountBasket();
deleteFromBasket();
buyer();
    //ranjer();
    special_cards_hover();
    lightbox_options();

});