/**
 * Created by admin on 18.04.17.
 */
$(document).ready(function(){

    function ajax_combo()
    {
        var added_city = {};
        var city_to_add = $('#cities_to_add');
        var now_combo  = 0;

        var added_category = {};
        var category_to_add = $('#categories_to_add');
        var now_category  = 0;

        var now_city = 0;
        var now_category_id = 0;

        var added_advert = {};
        var adverts_to_add = $('#adverts_to_add');

        var geted_categories = $('#geted_categories');
        var geted_cities = $('#geted_cities') ;
        var geted_adverts = $('#geted_adverts');



        $('.btn_city').on('click', function(){
                var dd = $(this).attr('id');
                dd = dd.split('-');
                now_combo = dd[1];
        });


        function click_add_category()
        {
            $('.btn_category').on('click', function(){
                var dd = $(this).attr('id');
                dd = dd.split('-');
                now_category = dd[1];
                now_city = $(this).data('city');
            });
        }

        function click_add_advert()
        {
            $('.btn_advert').on('click', function(){
                var dd = $(this).attr('id');
                dd = dd.split('-');
                now_category = dd[1];
                now_city = dd[2];
                now_category_id = dd[3];
                console.log = (now_category + ' ' + now_city + ' ' + now_category_id);
            });
        }

        function delete_city_main()
        {
            $('.delete_city_main').on('click', function()
            {

                var my_id = $(this).attr('id');
                my_id = my_id.split('-');
                my_id = my_id[1];
                $.ajax({
                    url : '/admin/combos/ajax/delete_city/' + my_id,
                    type: "get",
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success:function(data) {
                        if( data == my_id )
                        {
                            $('#to_del_city-' + data).remove();
                        }
                    },
                    errors:function(a,b) { alert('Сервер не отвечает');}
                });

            });
        }

        function delete_category_main()
        {
            $('.delete_category_main').on('click', function()
            {

                var my_id = $(this).attr('id');
                my_id = my_id.split('-');
                my_id = my_id[1];
                $.ajax({
                    url : '/admin/combos/ajax/delete_category/' + my_id,
                    type: "get",
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success:function(data) {
                        if( data == my_id )
                        {
                            $('#combocitcategor-' + data).remove();
                        }
                    },
                    errors:function(a,b) { alert('Сервер не отвечает');}
                });

            });
        }

        function delete_advert_main()
        {
            $('.delete_advert_main').on('click', function()
            {

                var my_id = $(this).attr('id');
                my_id = my_id.split('-');
                my_id = my_id[1];
                $.ajax({
                    url : '/admin/combos/ajax/delete_advert/' + my_id,
                    type: "get",
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success:function(data) {
                        if( data == my_id )
                        {
                            $('#advert-' + data).remove();
                        }
                    },
                    errors:function(a,b) { alert('Сервер не отвечает');}
                });

            });
        }

        $('.close_cities').on('click', function () {
            geted_cities.html(' ');
            added_city = {};
            city_to_add.html(' ');
        });

        $('.close_categories').on('click', function () {
            geted_categories.html(' ');
            added_category = {};
            category_to_add.html(' ');
        });

        $('.close_advert').on('click', function () {
            geted_adverts.html(' ');
            added_advert = {};
            adverts_to_add.html(' ');
        });

        function delete_city()
        {
            $('.delete_city').on('click', function(){
                var my_id = $(this).attr('id');
                my_id = my_id.split('-');
                my_id = my_id[1];
                delete added_city[my_id];
                $('#addedcity-' + my_id).remove();
            });
        }

        function add_city()
        {
            $('.add_city').on('click', function(){

                var my_name = $(this).attr('data-name');
                var my_id = $(this).attr('id');
                my_id = my_id.split('-');
                my_id = my_id[1];


                if(!(my_id in added_city))
                {
                    city_to_add.append("<span class='added_city_ajax' id='addedcity-" + my_id + "'>" + my_name + "<span id='delete_added_city-" + my_id + "' class='delete_city'>X</span><span>");
                }

                added_city[my_id] = my_name;

                delete_city();
            });
        }

        $('#go_search').on('click', function(){
            $.ajax({
                url: '/admin/combos/ajax/get_cities',
                type: "get",
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(data) {
                   $('#geted_cities').html('');
                   var append_cities = "";
                   append_cities = "<table class='table table-striped table-bordered table-hover table-condensed'><th>ID</th><th>Нанименование</th><th style='width:50px;'>Функции</th>";
                   data.forEach(function(item, i){
                       append_cities = append_cities + "<tr>" +
                               "<td>" + (i+1) + "</td>" +
                               "<td>" + item.name + "</td>" +
                               "<td><button id='city-" + item.id + "' class='btn btn-success add_city' data-name='" + item.name + "'><i class='fa fa-plus'></i></button></td>" +
                               "</tr>";
                   });
                   append_cities = append_cities + "</table>";
                   $('#geted_cities').html(append_cities);
                   add_city();
                },
                errors:function(a,b) { alert('Сервер не отвечает');}
            });
        });


        $('#sent_city_to_server').on('click', function(){
            var json = JSON.stringify(added_city);
            $.ajax({
                url: '/admin/combos/ajax/set_cities/' + now_combo,
                type: 'POST',
                data: {"data" : json},
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(data) {
                    switch (data) {
                        case 'error_valid': alert('Некоторые категории уже добавлены'); break;
                        case 'error_data': alert('Переданные данные пусты, для исправления попробуйте перезагрузить страницу'); break;
                        case 'error_keys': alert('Ошибка в переданных данных'); break;
                        default:
                            var to_render = "";
                            var for_redner = "";
                            data.forEach(function(city,index){
                                for_redner = city.combo.id;
                                to_render = to_render + "<tr id='to_del_city-" + city.id + "'>" +
                                    "<td colspan='6'>" +
                                    "<span style='float:left; color:red; font-size:16px;'>" + city.cit.name + "</span>" +
                                    "<label class='btn btn-danger delete_city_main' style='float:right; padding:0 3px;' title='Удалить город' id= 'delcit-" + city.id + "'><i class='fa fa-trash-o'></i></label>" +
                                    "<a href='#modalCategory' class='btn btn-info btn_category' style='float:right; padding:0 3px; margin-right:5px;'  data-city='" + city.cit.id + "' data-toggle='modal' title='Добавить категорию' id='addcat-" + city.id + "'><i class='fa fa-plus'></i></a>" +
                                    "<table style='table table-striped table-bordered table-hover table-condensed'><tr><td id='combocit-" + city.id + "'></td></tr></table>" +
                                    "</td></tr>";
                            });
                            $('#combo-' + for_redner).after(to_render);
                    }
                    added_city = {};
                    city_to_add.html('');
                    geted_cities.html('');
                    click_add_category();

                    delete_city_main();
                },
                errors:function(a,b) { alert('Сервер не отвечает');}
            });
        });


        //city end

        //category begin



        function delete_category()
        {
            $('.delete_category').on('click', function(){
                var my_id = $(this).attr('id');
                my_id = my_id.split('-');
                my_id = my_id[1];
                delete added_category[my_id];
                $('#addedcategory-' + my_id).remove();
            });
        }


        function add_category()
        {
            $('.add_category').on('click', function(){

                var my_name = $(this).attr('data-name');
                var my_id = $(this).attr('id');
                my_id = my_id.split('-');
                my_id = my_id[1];


                if(!(my_id in added_category))
                {
                    category_to_add.append("<span class='added_category_ajax' id='addedcategory-" + my_id + "'>" + my_name + "<span id='delete_added_category-" + my_id + "' class='delete_category'>X</span><span>");
                }

                added_category[my_id] = my_name;

                delete_category();
            });
        }

        $('#go_search_categories').on('click', function(){
            $.ajax({
                url: '/admin/combos/ajax/get_categories',
                type: "get",
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(data) {
                    $('#geted_categories').html('');
                    var append_categories = "";
                    append_categories = "<table class='table table-striped table-bordered table-hover table-condensed'><th>ID</th><th>Нанименование</th><th style='width:50px;'>Функции</th>";
                    data.forEach(function(item, i){
                        append_categories = append_categories + "<tr>" +
                            "<td>" + (i+1) + "</td>" +
                            "<td>" + item.name + "</td>" +
                            "<td><button id='city-" + item.id + "' class='btn btn-success add_category' data-name='" + item.name + "'><i class='fa fa-plus'></i></button></td>" +
                            "</tr>";
                    });
                    append_categories = append_categories + "</table>";
                    $('#geted_categories').html(append_categories);
                    add_category();
                },
                errors:function(a,b) { alert('Сервер не отвечает');}
            });
        });


        $('#sent_category_to_server').on('click', function(){
            var json = JSON.stringify(added_category);
            $.ajax({
                url: '/admin/combos/ajax/set_categories/' + now_category,
                type: 'POST',
                data: {"data" : json},
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(data) {
                    switch (data) {
                        case 'error_valid': alert('Некоторые категории уже добавлены'); break;
                        case 'error_data': alert('Переданные данные пусты, для исправления попробуйте перезагрузить страницу'); break;
                        case 'error_keys': alert('Ошибка в переданных данных'); break;
                        default:
                            var to_render = "";
                            var for_redner = "";
                            data.forEach(function(category,index){
                                for_redner = category.combo_cit_id;
                                to_render = to_render + "<div style='padding:5px; margin:10px; display:inline-block; text-align:left; border:1px solid black;' id='combocitcategor-" + category.id + "'>" +
                                    "<span style='color:blue; font-size:14px; margin-right:10px;'>" + category.advert_categor.name + "</span>" +
                                    "<label class='btn btn-danger delete_category_main' title='Удалить категорию' style='float:right; padding:0 3px;' id='delcategory-" + category.id + "'><i class='fa fa-trash-o'></i></label>" +
                                    "<a href='#modalAdvert' title='Добавить объявление' class='btn btn-info btn_advert' data-toggle='modal' style='float:right; padding:0 3px; margin-right:5px;' id='addadvert-" + category.id + "-" + now_city + "-" + category.advert_categor_id + "'><i class='fa fa-plus'></i></a>" +
                                    "</div>";
                            });

                            $('#combocit-' + for_redner).append(to_render);
                            click_add_advert();
                    }
                    added_category = {};
                    category_to_add.html('');
                    geted_categories.html('');
                    delete_category_main();

                },
                errors:function(a,b) { alert('Сервер не отвечает');}
            });
        });

        /////////// categories end

        ///////////adverts begin




        function delete_advert()
        {
            $('.delete_advert').on('click', function(){
                var my_id = $(this).attr('id');
                my_id = my_id.split('-');
                my_id = my_id[1];
                delete added_advert[my_id];
                $('#addedadvert-' + my_id).remove();
            });
        }


        function add_advert()
        {
            $('.add_advert').on('click', function(){

                var my_name = $(this).attr('data-name');
                var my_id = $(this).attr('id');
                my_id = my_id.split('-');
                my_id = my_id[1];


                if(!(my_id in added_advert))
                {
                    adverts_to_add.append("<span class='added_advert_ajax' id='addedadvert-" + my_id + "'>" + my_name + "<span id='delete_added_advert-" + my_id + "' class='delete_advert'>X</span><span>");
                }

                added_advert[my_id] = my_name;

                delete_advert();
            });
        }




        $('#go_search_adverts').on('click', function(){
            $.ajax({
                url: '/admin/combos/ajax/get_adverts',
                type: "post",
                data: { "city": now_city, "category": now_category_id},
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(data) {
                    var render = "<table class='table table-striped table-bordered table-hover table-condensed mytabler'>";
                    render = render + "<th>Фото</th><th>Описание</th><th style='width:50px;'>Города</th><th style='width:30px;'>Функции</th>";


                    data.forEach(function(item, i, data) {

                        var photo = '';
                        var cities = '';
                        var need_color = 'red';

                        if (item.advert_stat_id == 1) {need_color = 'green';}

                        item.photos.forEach(function(item2){
                            photo = item2.path;
                        });

                        item.advert_cits.forEach(function(adv_cit){
                            cities = "<p><span style='color:green;'>" + adv_cit.cit.name + "</span>:";
                            if(adv_cit.dogovor == 1)
                            {
                                cities = cities + "<span>Договорная</span>";
                            }
                            else
                            {
                                cities = cities + "<span>" + adv_cit.price + "</span> - " + "<span>" + adv_cit.price_two + "</span>";
                            }
                            cities = cities + "</p>"
                        });

                        render = render + "<tr>";
                        render = render + "" +
                            "<td class='photoTD'><img class='adv_img' src='/" + photo + "'></td> " +
                            "<td><div><span class='adv_name'>" + item.name + "</span><span style='color:" + need_color + ";' class='adv_status'>" + item.advert_stat.name + "</span><span class='adv_categor'>" + item.advert_categor.name + "</span></div><div class='descrip_style'><span class='adv_descri'>" + item.description + "</span></div></td>" +
                            "<td>" + cities + "</td>" +
                            "<td><button id='adder-" + item.id + "' class='btn btn-success add_advert' data-name='" + item.name + "'><i class=' fa fa-plus'></i></button></td>";
                        render = render + "</tr>";
                    });
                    render = render + "</table>";
                    $('#geted_adverts').html(render);
                    adverts_to_add.html('');
                    add_advert();
                },
                errors:function(a,b) { alert('Сервер не отвечает');}
            });
        });


        $('#sent_adverts_to_server').on('click', function(){
            var json = JSON.stringify(added_advert);
            $.ajax({
                url: '/admin/combos/ajax/set_adverts/' + now_category,
                type: 'POST',
                data: {"data" : json},
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(data) {
                    switch (data) {
                        case 'error_valid': alert('Некоторые категории уже добавлены'); break;
                        case 'error_data': alert('Переданные данные пусты, для исправления попробуйте перезагрузить страницу'); break;
                        case 'error_keys': alert('Ошибка в переданных данных'); break;
                        default:
                            var to_render = "";
                            data.forEach(function(advert,index){
                                for_redner = advert.combo_cit_categor_id;
                                to_render = to_render + "<div id='advert-" + advert.id + "'>" +
                                    "<span style='color:green; font-size:14px; margin-bottom:3px;'><a href='/advert/" + advert.advert.id + "'>" + advert.advert.name + "</a></span>" +
                                    "<label class='btn btn-danger delete_advert_main' title='Удалить объявление' style='padding:0 3px;' id='deladvert-" + advert.id + "'><i class='fa fa-trash-o'></i></label>" +
                                    "</div>";
                            });
                            $('#combocitcategor-' + now_category).append(to_render);
                    }
                    added_advert= {};
                    adverts_to_add.html('');
                    geted_adverts.html('');
                    delete_advert_main();
                },
                errors:function(a,b) { alert('Сервер не отвечает');}
            });
        });

        delete_city_main();
        delete_category_main();
        delete_advert_main();
        click_add_advert();
        click_add_category();

    }

    ajax_combo();

});