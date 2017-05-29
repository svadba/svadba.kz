/**
 * Created by admin on 18.04.17.
 */
$(document).ready(function () {


    function ranjer() {
        $("#slider-range").slider(
            {
                range: true,
                min: 1,
                max: 10000000,
                values: [75, 5000000],
                slide: function (event, ui) {
                    $("#amount").val("" + ui.values[0] + " - " + ui.values[1] + "т");
                }
            });

        $("#amount").val("" + $("#slider-range").slider("values", 0) +
            " - " + $("#slider-range").slider("values", 1) + "т");
    }

    function like_svadba() {
        $('#sv_like').on('click', function () {
            $.ajax({
                url: "/like_svadba",
                type: "get",
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },

                success: function (data) {
                    $('#sv_l').html(data);
                },
                error: function (a, b) {
                    alert('Сервер не отвечает попробуйте позже!')
                }
            });
        });
    }

    // возвращает cookie с именем name, если есть, если нет, то undefined
    function getCookie(name) {
        var matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }

    //устанавливает куку
    function setCookie(name, value, date) {
        document.cookie = name + "=" + value + "; path=/; expires=" + date;
    }

    //добавляет значение к куке
    function addCookie(name, lastValue, value, date) {
        document.cookie = name + "=" + lastValue + "," + value + "; path=/; expires=" + date;
    }

    //устанавливает в шапке количество объявленимй в корзине
    function setCountBasket() {
        var basket = getCookie('basket');
        if (basket) {
            var splitbasket = basket.split(',');
            $('#count_basket').html(splitbasket.length);
        }
        else {
            $('#count_basket').html('0');
        }
    }

    function deleteFromBasket() {
        $('.del_from_bask').on('click', function () {
            basket = getCookie('basket');
            if (basket) {
                var id = $(this).attr('id');
                var splitBasket = basket.split(',');
                if (splitBasket.length) {
                    console.log('split_baskt_do_foeach = ' + splitBasket);
                    splitBasket.forEach(function (item, i) {
                        if (item == id) {
                            splitBasket.splice(i, 1);
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


    function buyer() {
        $('.buy-btn').on('click', function () {

            var date = new Date;
            date.setDate(date.getDate() + 3);
            date = date.toUTCString();

            var id = $(this).attr('id');

            basket = getCookie('basket');

            if (basket) {
                var splitBasket = basket.split(',');

                if (splitBasket.length == 0) {
                    setCookie('basket', id, date);
                }
                else {
                    var flag = false;
                    for (var i = 0; i < splitBasket.length; i++) {
                        if (splitBasket[i] == id) {
                            flag = true;
                        }
                    }
                    if (!flag) {
                        addCookie('basket', basket, id, date);
                    }
                }
            }
            else {
                setCookie('basket', id, date);
            }

            setCountBasket();

        });
    }

    function semantic_ui() {
        // hover for cards
        $('.special.cards .image').dimmer({
            on: 'hover'
        });
        // rating views
        $('.ui.rating')
            .rating('disable')
        ;
        //dropdown for select
        $('.ui.dropdown')
            .dropdown()
        ;
    }

    function lightbox_options() {
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true,
            'albumLabel': "%1 из %2",
            'alwaysShowNavOnTouchDevices': true
        })
    }


    $('.dekBut').on('click', function () {

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

    $('.setCombo').on('click', function () {

        var date = new Date;
        date.setDate(date.getDate() + 3);
        date = date.toUTCString();

        var comboObj = {};
        comboObj.combo = $('input[name=combo]').val();
        comboObj.combo_cit = $('input[name=combo_cit]').val();

        $('.radioAdv[checked]').each(function () {
            comboObj[$(this).attr('name')] = $(this).val();
        });

        var combo_json = JSON.stringify(comboObj);
        console.log(combo_json);
        setCookie('combo', combo_json, date);
        AddToBasket();
    });

    function set_checked() {
        var combo_cook = getCookie('combo');
        var combo = '';
        if (combo_cook) {
            combo = JSON.parse(combo_cook);
            $all_radio = $('.radioAdv');

            $all_radio.each(function () {

                var radio_name = $(this).attr('name');
                var radio_val = $(this).val();

                for (key in combo) {
                    if ((radio_name == key) && (radio_val == combo[key])) {
                        $('.baseAdvDiv-' + key).removeClass('activeAdvert');
                        $('#baseAd-' + combo[key]).addClass('activeAdvert');
                        $(this).attr('checked', true);
                    }
                }

            });

        }
    }

    function combo_change() {
        var chenged_adv = '';

        $('.change_adv').on('click', function () {
            var id = $(this).attr('id');
            var split_id = id.split('-');
            chenged_adv = split_id[1];
            console.log(chenged_adv);
        });

        $('.take_adv').on('click', function () {
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
            advert_desibl = $(this);
            console.log(advert_desibl);
        });

        $('.save_adv').on('click', function () {
            var id = $(this).attr('id');
            var split_id = id.split('-');
            var categor_id = split_id[1];
            var take_adv = $('.minadvdiv-' + categor_id + '.activeMinAdv').attr('id');
            var take_adv_id = take_adv.split('-');
            take_adv_id = take_adv_id[1];
            console.log(take_adv_id);
            var combo_cook = getCookie('combo');

            combo_cook = JSON.parse(combo_cook);

            if (categor_id in combo_cook) {
                combo_cook[categor_id] = take_adv_id;
                combo_cook = JSON.stringify(combo_cook);
                var date = new Date;
                date.setDate(date.getDate() + 3);
                date = date.toUTCString();
                setCookie('combo', combo_cook, date);

                $.ajax({
                    url: "/ajax/get_advert/" + take_adv_id,
                    type: "get",
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },

                    success: function (data) {
                        var main_photo = '';
                        var photos = '';
                        data.photos.forEach(function (item) {
                            if (item.main == 1) {
                                main_photo = '<img src="/upload/adverts/thumbs/' + item.name + '.' + item.ext + '" alt="">';
                            }
                            else {
                                photos = photos + '<div class="col-xs-3 photo-advert" style="background-image: url(' + item.path + ');"></div>';
                            }
                        });
                        var render =
                            '<div class="col-xs-12 baseAdvDiv-' + categor_id + '" id="baseAd-' + data.id + '" style="width: 20%;">' +
                            '<div class="card">' +
                            '<div class="blurring dimmable image">' +
                            '<div class="ui dimmer">' +
                            '<div class="content">' +
                            '<div class="center">' +
                            '<div style="max-height: 72.5px; overflow: hidden; text-overflow: ellipsis;">' +
                            data.description + '</div>' +
                            photos +
                            '</div></div></div>' +
                            main_photo +
                            '</div>' +
                            '<div class="content">' +
                            '<div class="header text-center" style="font-size: 12px;">' + data.name + ' ' + data.advert_categor.name + '</div>' +
                            '</div>' +
                            '<div class="extra content">' +
                            '<div class="ui two buttons">' +
                            '<a id="change-' + data.id + '" href="#modal' + categor_id + '" data-toggle="modal" class="ui basic teal button">Изменить</a>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            "</div>";
                        var baseAdvert = $('#baseAd-' + chenged_adv);
                        console.log(baseAdvert);
                        console.log(render);
                        var prepAdvert = baseAdvert.prev();

                        if (prepAdvert.length) {
                            prepAdvert.after(render);
                            console.log('prep');
                            console.log(prepAdvert);
                        }
                        else {
                            var parentAdvert = baseAdvert.parent();
                            parentAdvert.append(render);
                            console.log('parent');
                            console.log(parentAdvert);
                        }
                        baseAdvert.remove();
                    },
                    error: function (a, b) {
                        alert('Сервер не отвечает попробуйте позже!')
                    }
                });

                console.log(combo_cook);
            }

            //$('#modal' + categor_id).modal('hide');

        });
    }

    function AddToBasket() {
        var modal = document.getElementById('myModal');
        var btn = document.getElementById("myBtn");
        var span = document.getElementsByClassName("close")[0];
        modal.style.display = "block";
        $(modal).fadeOut(3000);
        //Close function
        span.onclick = function () {
            modal.style.display = "none";
        };
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    }

    $('.createPrice').on('click', function (event) {
        event.preventDefault();
        var checkboxIds = [];
        $('.checkbox').each(function (index) {
            checkboxIds[index] = $(this).attr('id');
        });
        var lastCheckboxIds = checkboxIds[checkboxIds.length - 1];
        var lastId = lastCheckboxIds.substr(8);
        var id = Number(lastId) + 1;
        var priceWithoutClose = document.getElementsByClassName("priceWithoutClose");
        var price = $(priceWithoutClose).clone();
        $(price).find('input').val('');
        var price = $(price).removeClass('priceWithoutClose');
        $(price).find('.checkbox').attr('id', 'checkbox' + id);
        $(price).find('.checkbox').attr('name', 'dogovor[' + id + ']');
        $(price).find('label').attr('for', 'checkbox' + id);
        $(price).find('select').attr('name', 'advert_cits[' + id + ']');
        $(price).find('.prices').attr('name', 'prices[' + id + ']');
        $(price).find('.prices_two').attr('name', 'prices_two[' + id + ']');
        var closeButton = document.createElement('div');
        closeButton.className = 'col-xs-12';
        closeButton.innerHTML = '<button type="button" class="close" aria-label="Close" onclick="$(this).closest(\'.price\').remove()"><span aria-hidden="true">&times;</span></button>';
        $(price).prepend(closeButton);
        price.insertBefore('.createPrice');
    });

    $('.addVideo').on('click', function () {
        var video = document.getElementById("youtube_videoId").value;
        $('#youtube_videoId').css('color', '#555');
        var videoUrl = /(^https:\/\/youtu.be\/)[a-zA-Z0-9-]/;
        var videoValidation = videoUrl.test(video);
        if (videoValidation == true) {
            var videoId = video.substr(17);
            var videoBlock = document.createElement('div');
            videoBlock.className = "col-xs-4 col-sm-3 col-md-2";
            videoBlock.innerHTML = '<img src="//img.youtube.com/vi/' + videoId + '/1.jpg" class="img-responsive margin-top-always advert_video center-block" id="' + videoId + '">';
            $(".videoPanel").append(videoBlock);
        } else {
            $('#youtube_videoId').css('color', '#FF4469');
            $('#youtube_videoId').addClass('unvalid');
            setTimeout(function () {
                $('#youtube_videoId').removeClass('unvalid');
            }, 666);
            $('#youtube_videoId').val('Ссылка неверна');
        }
    });

    $('.saveVideoAdvert').on('click', function () {
        var videoIds = '';
        var advertId = $('.massive.fluid.ui.teal.basic.button').attr('id');

        $('.video_panel img').each(function (index) {
            videoIds = videoIds + $(this).attr('id') + ',';
        });
        videoIds = videoIds.substr(0, videoIds.length - 1);
        var ids_array = videoIds.split(',');
        var render = '';
        ids_array.forEach(function (item, i, arr) {
            alert(i + ": " + item + " (массив:" + arr + ")");
            //render = render + '<a href="https://youtu.be/' + element + '" data-lity><img src="//img.youtube.com/vi/' + element + '/1.jpg" class="img-responsive"></a>';
        });
        var videoBlock = document.createElement('div');
        videoBlock.className = "col-xs-4";
        videoBlock.innerHTML = render;
        $(".video_panel").append(videoBlock);
        /*if (videoIds) {
         $.ajax({
         url: '/admin/requests/basket/edit_combo_adverts/' + advertId,
         type: "POST",
         headers: {
         'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
         },
         data: {
         "videoIds": videoIds
         },
         success: function (data) {
         if (data) {
         var ids_array = videoIds.split(',');
         var render = '';
         ids_array.forEach(element)
         {
         render = render + '<div><img src=""/></div>';
         }
         innerHTML = render;
         }
         },
         error: function () {
         $('#modal' + take_categor_id).modal('hide');
         alert('Сервер не отвечает, попробуйте позже');
         }
         });
         }*/
    });

    like_svadba();
    lightbox_options();
    setCountBasket();
    deleteFromBasket();
    buyer();
    //set_checked();
    combo_change();
    //ranjer();
    semantic_ui();
});