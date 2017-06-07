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

            var combo = getCookie('combo');
            var basket_new = getCookie('basket');
            if (!combo) {
                if (!basket_new) {
                    window.location.replace('/');
                }
            }

        });
    }

    function deleteComboInBasket() {
        $('body').on('click', '.remove_combo', function () {

            var combo = '';
            var date = new Date;
            date.setDate(date.getDate() - 3);
            date = date.toUTCString();
            setCookie('combo', combo, date);
            var basket = getCookie('basket');
            if (!basket) {
                window.location.replace('/');
            }
            else {
                $('#combo').remove();
                $('.combo_modal').remove();
            }

        });

    }

    deleteComboInBasket();

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

    function edit_combo_in_basket() {

        var last_advert_id = '';
        var body = $('body');

        body.on('click', '.changeComboAdvertBasket', function () {

            var id = $(this).attr('id');
            id = id.split('-');
            var categor_id = id[1];
            last_advert_id = id[2];

            $('.ui.basic.modal#combomodal-' + categor_id).modal({blurring: true}).modal('show');
        });

        body.on('click', '.set_change_adv_combo', function () {

            if (last_advert_id)

                var id = $(this).attr('id');
            id = id.split('-');
            var categor_id = id[1];
            var advert_id = id[2];

            var combo_cook = getCookie('combo');
            combo_cook = JSON.parse(combo_cook);
            if (categor_id in combo_cook) {
                combo_cook[categor_id] = advert_id;
                combo_cook = JSON.stringify(combo_cook);
                var date = new Date;
                date.setDate(date.getDate() + 3);
                date = date.toUTCString();
                setCookie('combo', combo_cook, date);
                var adv_photo = $('#chAdvImg-' + advert_id).attr('src');
                var adv_name = $('#chAdvName-' + advert_id).html();
                var categor_name = $('#chAdvCategName-' + advert_id).html();

                var render = '' +
                    '<div class="column baseAdvDiv-' + categor_id + '" id="baseAd-' + advert_id + '">' +
                    '<div class="ui card">' +
                    '<div class="image">' +
                    '<img src="' + adv_photo + '" alt="">' +
                    '</div>' +
                    '<div class="content">' +
                    '<div class="header">' + adv_name + '</div>' +
                    '<div class="meta">' +
                    '<span class="date">' + categor_name + '</span>' +
                    '</div>' +
                    '</div>' +
                    '<div class="extra content">' +
                    '<a id="change-' + categor_id + '-' + advert_id + '" class="fluid ui basic teal button changeComboAdvertBasket">' +
                    '<i class="exchange icon"></i>Изменить</a>' +
                    '</div>' +
                    '</div>' +
                    '</div>';

                var baseAdvert = $('#baseAd-' + last_advert_id);
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
                $('.ui.basic.modal#combomodal-' + categor_id).modal('hide');
            }

        });

    }

    edit_combo_in_basket();


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

    function semantic_ui() {
        // hover for cards
        $('.special.cards .image').dimmer({
            on: 'hover'
        });
        // rating views
        $('.ui.rating')
            .rating('disable')
        ;
        $('.ui.dropdown')
            .dropdown()
        ;
        //tab
        $('.menu .item')
            .tab()
        ;
    }

    $('.addVideo').on('click', function () {
        var video = document.getElementById("youtube_videoId").value;
        var youtube_vid = $('#youtube_videoId');
        youtube_vid.css('color', '#555');
        var videoUrl = /(^https:\/\/youtu.be\/)[a-zA-Z0-9-]/;
        if (videoUrl.test(video)) {
            var videoId = video.substr(17);
            var videoBlock = document.createElement('div');
            videoBlock.className = "col-xs-4 col-sm-3 col-md-2";
            videoBlock.innerHTML = '<img src="//img.youtube.com/vi/' + videoId + '/1.jpg" class="img-responsive margin-top-always advert_video center-block" id="' + videoId + '">';
            $(".videoPanel").append(videoBlock);
        } else {
            youtube_vid.css('color', '#FF4469');
            youtube_vid.addClass('unvalid');
            setTimeout(function () {
                youtube_vid.removeClass('unvalid');
            }, 666);
            youtube_vid.val('Ссылка неверна');
        }
    });

    function del_video_in_base() {
        $('.delvideoInBase').on('click', function () {

            var this_id = $(this).attr('id');
            this_id = this_id.split('-');
            var advert_id = this_id[1];
            var video_id = this_id[2];

            if (advert_id && video_id) {
                $.ajax({
                    url: '/home/adverts/videos/delete',
                    type: "POST",
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        "video_id": video_id,
                        "advert_id": advert_id
                    },
                    success: function (data) {
                        if (data == video_id) {
                            $('#video-' + video_id).remove();
                            var countVideos = $('#countVideos');
                            countVideos.html(Number(countVideos.html()) - 1);
                        }
                    },
                    error: function (jqHML) {
                        alert('Сервер не отвечает, попробуйте позже');
                    }
                });
            }
        });
    }

    $('.saveVideoAdvert').on('click', function () {
        console.log('start_saveVIdeo');
        var videoIds = '';
        var attr_id = $(this).attr('id');
        attr_id = attr_id.split('-');
        attr_id = attr_id[1];
        console.log('attr id ' + attr_id);
        $('.advert_video').each(function (index) {
            videoIds = videoIds + $(this).attr('id') + ',';
        });
        videoIds = videoIds.substr(0, videoIds.length - 1);
        console.log('videoIds ' + videoIds);
        if (videoIds) {
            console.log('videoIds start_ajax id ' + videoIds);
            $.ajax({
                url: '/home/adverts/videos/add',
                type: "POST",
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    "videoIds": videoIds,
                    "advert_id": attr_id
                },
                success: function (data) {
                    if (data.result = 'true') {
                        var data_json = JSON.parse(data);
                        console.log(data);
                        var ids = data_json.videos;
                        var countVideos = $('#countVideos');
                        var nowCountVideos = Number(countVideos.html());
                        var render = '';
                        ids.forEach(function (element) {
                            render = render +
                                '<div id="video-' + element.id + '" class="col-xs-6 col-md-4 margin-top-always">' +
                                '<a href="//www.youtube.com/watch?v=' + element.youtube_video_id + '" data-lity style="width:100%;">' +
                                '<img src="//img.youtube.com/vi/' + element.youtube_video_id + '/1.jpg" class="img-responsive center-block" id="">' +
                                '</a>' +
                                '<button class="fluid mini ui negative button delvideoInBase" id="delvideo-' + attr_id + '-' + element.id + '" style="border-top-left-radius: 0;border-top-right-radius: 0;">' +
                                '<i class="remove icon" title="Удалить видео"></i>' +
                                '</button>' +
                                '</div>';
                            nowCountVideos++;
                        });

                        countVideos.html(nowCountVideos);
                        $('.videoBlock').append(render);
                        del_video_in_base();
                    }
                    else {
                        if (data.error = 'bad_ids_array') {
                            alert('Ошибка в переданных данных!');
                        }
                        else {
                            alert('Неизвестная ошибка!');
                        }
                    }
                },
                error: function () {
                    //$('#modal' + take_categor_id).modal('hide');
                    alert('Сервер не отвечает, попробуйте позже');
                }
            });
        }
        $('.videoPanel').html('');
    });


    like_svadba();
    lightbox_options();
    setCountBasket();
    deleteFromBasket();
    buyer();
    del_video_in_base();
    //set_checked();
    //ranjer();
    semantic_ui();
});