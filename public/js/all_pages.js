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
                    var new_bask = splitBasket.join(',');
                    var date = new Date;
                    date.setDate(date.getDate() + 3);
                    date = date.toUTCString();
                    setCookie('basket', new_bask, date);
                    setCountBasket();
                    $('#bask_' + id).remove();
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
            'resizeDuration': 200,
            'wrapAround': true,
            'albumLabel': "%1 из %2",
            'alwaysShowNavOnTouchDevices': true
        })
    }


    $('.dekBut').on('click', function(){

        var id = $(this).attr('id');
        var split_id = id.split('-');
        var advert_id = split_id[2];
        var categor_id = split_id[1];
        $('.baseAdvDiv-' + categor_id).removeClass('activeAdvert');
        $('#baseAd-' + advert_id).addClass('activeAdvert');
        $('.radio-' + categor_id).attr('checked', false);
        $('#' + advert_id).attr('checked', true);
        console.log(advert_id);
        console.log(categor_id);
        console.log($('.radioAdv[checked]'));
    });

    $('.setCombo').on('click', function(){

        var date = new Date;
        date.setDate(date.getDate() + 3);
        date = date.toUTCString();

        var comboObj = {};
        comboObj.combo = $('input[name=combo]').val();
        comboObj.combo_cit = $('input[name=combo_cit]').val();

        $('.radioAdv[checked]').each(function(){
            comboObj[$(this).attr('name')] = $(this).val();
        });

        var combo_json = JSON.stringify(comboObj);
        console.log(combo_json);
        setCookie('combo', combo_json, date);

    });

    function set_checked()
    {
        var combo_cook = getCookie('combo');
        var combo = '';
        if(combo_cook)
        {
            combo = JSON.parse(combo_cook);
            $all_radio = $('.radioAdv');

            $all_radio.each(function(){

                var radio_name = $(this).attr('name');
                var radio_val = $(this).val();

                for (key in combo) {
                    if( (radio_name == key) && (radio_val == combo[key]))
                    {
                        $('.baseAdvDiv-' + key).removeClass('activeAdvert');
                        $('#baseAd-' + combo[key]).addClass('activeAdvert');
                        $(this).attr('checked', true);
                    }
                }

            });


        }
    }

    function combo_change()
    {
        $('.take_adv').on('click', function(){
            var id = $(this).attr('id');
            var split_id = id.split('-');
            var advert_id = split_id[1];
            var categor_id = split_id[2];
            console.log(advert_id);
            console.log(categor_id);
            $('.minadvdiv-' + categor_id).removeClass('activeMinAdv');
            console.log($('.minadvdiv-' + categor_id));
            $('#minadv-' + advert_id).addClass('activeMinAdv');
            console.log($('#minadv-' + advert_id));
        });

        $('.save_adv').on('click', function(){
            var id = $(this).attr('id');
            var split_id = id.split('-');
            var categor_id = split_id[1];
            var take_adv = $('.minadvdiv-' + categor_id + '.activeMinAdv').attr('id');
            var take_adv_id = take_adv.split('-');
            take_adv_id = take_adv_id[1];

            var combo_cook = getCookie('combo');

            combo_cook = JSON.parse(combo_cook);

            if(categor_id in combo_cook)
            {
                combo_cook[categor_id] = take_adv_id;
                combo_cook = JSON.stringify(combo_cook);
                var date = new Date;
                date.setDate(date.getDate() + 3);
                date = date.toUTCString();
                setCookie('combo',combo_cook,date);

                $('#baseAd-' + take_adv_id).remove();
                $('#modal' + categor_id).modal('hide');
                console.log(combo_cook);
            }

        });
    }



    like_svadba();
    special_cards_hover();
    lightbox_options();
    setCountBasket();
    deleteFromBasket();
    buyer();
    //set_checked();
    combo_change();
    //ranjer();



});