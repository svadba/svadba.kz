@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="">
            <div class="panel panel-default ">
                <div class="panel-heading"><h3 style="font-size:20px; margin-bottom:15px;">Заявка № {{$basket->id}}</h3>
                    <div>
                        <ul style="margin:5px 0px 10px -35px;">
                        </ul>
                    </div>
                    <a href="{{secure_url('admin/requests/baskets')}}" class="btn btn-default">
                        <i class="fa fa-star"></i> Заявки из корзин
                    </a>
                    <a href="{{secure_url('admin/requests/baskets')}}" class="btn btn-default">
                        <i class="fa fa-list-ul"></i> Заявки из пакетов
                    </a>
                </div>


                <div class="panel-body col-xs-12">
                    @include('common.errors')
                    <table style="font-size:16px; max-width:500px;" class="table table-striped table-bordered table-hover table-condensed table-responsive">
                        <tr>
                            <td>Заявка №</td>
                            <td id="basket_id" style="color:darkblue;">{{$basket->id}}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Имя клиента</td>
                            <td>{{$basket->name}}</td>
                            <TD></TD>
                        </tr>
                        <tr>
                            <td>Телефон клиента </td>
                            <td>{{$basket->phone}}</td>
                            <TD></TD>
                        </tr>
                        <tr>
                            <td>Почтовый адрес клиента</td>
                            <td>{{$basket->email}}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Дата создания заявки</td>
                            <td>{{$basket->created_at}}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Дата мероприятия</td>
                            <td>
                                <form style="display:inline-block; " method="POST" id="form_tusa" action="{{secure_url('/admin/requests/basket/save_tusa/'.$basket->id)}}">
                                    {{ csrf_field() }}
                                    <input style="color:@if($basket->tusa_at) green @else red @endif;" type='text' value="{{$basket->tusa_at or 'Не указанна'}}" name="tusa_at" class="datepicker-here" data-date-format="yyyy-mm-dd" data-timepicker="true" data-time-format="hh:ii:00" data-position="right top bottom" />

                                </form>
                            </td>
                            <td>
                                <button form="form_tusa" type="submit" class="btn btn-success" title="Сохранить дату мероприятия"><span class="glyphicon glyphicon-ok" aria-hidden="true"></button>
                            </td>
                        </tr>
                        <tr>
                            <td>Статус заявки</td>
                            <td>
                                @if($basket->ended == 1) <span style="color:green;"> Завершена </span> @else <span style="color:red;"> Не завершена </span> @endif
                            </td>
                            <td>@if($basket->ended != 1) <a style="" class="btn btn-success" title="Завершить заявку" href="{{secure_url('admin/requests/basket/set_end/'.$basket->id)}}"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a> @endif</td>
                        </tr>
                        @if($basket->ended == 1)
                        <tr>
                            <td>Дата завершения заявки</td>
                            <td>{{$basket->ended_at}}</td>
                            <td></td>
                        </tr>
                        @endif
                    </table>
                    <br>
                    @if($combo_requests->count())
                        <h4 style="font-weight:bold;">Пакеты заказанные клиентом:</h4>
                        @foreach($combo_requests as $com_req)
                            <div class="col-xs-12" style="border:solid 1px green; padding:15px 10px;" id="combo_req-{{$com_req->id}}">
                                <h5>Наименование пакета: <span id="namecomboreq-{{$com_req->id}}" style="color:green; font-weight:bold;">{{$com_req->combo->name}}</span></h5>
                                <h5>Наименование города для пакета: <span id="citcomboreq-{{$com_req->id}}" style="color:green; font-weight:bold;">{{$com_req->combo_cit->cit->name}}</span></h5>
                                <h5>Цена пакета: <span style="color:green; font-weight:bold;">{{$com_req->combo->price}}</span></h5>
                                <div class="col-xs-12">
                                    <table class="table table-striped table-bordered table-hover table-condensed main_table">
                                        <tr>
                                            <th>ID</th>
                                            <th>Наименование</th>
                                            <th>Категория</th>
                                            <th>Функции</th>
                                        </tr>
                                        <?php $count = 1; ?>
                                        @foreach($com_req->combo_cit->combo_categors as $combo_categor)
                                            @foreach($combo_categor->adverts as $advert)
                                                @foreach($com_req->geted_adverts() as $advert_basket)
                                                        @if($advert->id == $advert_basket)
                                                            <tr>
                                                                <td id="td-{{$advert->id}}-1">{{$count}}</td>
                                                                <td id="td-{{$advert->id}}-2"><a href="{{secure_url('/advert/'.$advert->id)}}">{{$advert->name}}</a></td>
                                                                <td id="td-{{$advert->id}}-3">{{$advert->advert_categor->name}}</td>
                                                                <td id="td-{{$advert->id}}-4"><a href="#modal-{{$combo_categor->id}}" data-toggle="modal" id="change-{{$advert->id}}-{{$combo_categor->id}}-{{$com_req->id}}" class="btn btn-info change_adv">Заменить</a></td>
                                                            </tr>
                                                        @endif
                                                @endforeach
                                            @endforeach
                                        <?php $count++; ?>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="col-xs-12">
                                    <button id="delcomb-{{$com_req->id}}" style="float:right;" class="btn btn-danger delete_combo">Удалить пакет из заказа</button>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    <br>
                    <h4 style="font-weight:bold;">Таблица объявлений заказанных клиентом:</h4>
                    <form method="post" action="{{secure_url('admin/requests/basket/delete_adverts/'.$basket->id)}}">
                        {{csrf_field()}}
                    <table class="table table-striped table-bordered table-hover table-condensed main_table" cellspacing='0'>
                        <tr>
                            <th class="counter_big" style="background: #e6e6e6;">№</th>
                            <th style="background: #e6e6e6;">Наименование</th>
                            <th style="background: #e6e6e6;">Категория</th>
                            <th style="background: #e6e6e6;">Райтинг</th>
                            <th style="background: #e6e6e6;">Города</th>
                            <th style="background: #e6e6e6;">Номера телефонов</th>
                            <th style="background: #e6e6e6;">Статус работы</th>
                            <th style="background: #e6e6e6;">Функции</th>
                            <th style="background: #e6e6e6; text-align:center; max-width:20px;"><input type="checkbox" id="delete_adverts_main"></th>
                        </tr>
                        <?php $count = 1;?>
                        @foreach ($adverts as $adv)
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><a href="{{secure_url('advert/'.$adv->id)}}">{{$adv->name}}</a></td>
                            <td>{{$adv->advert_categor->name}}</td>
                            <td>{{$adv->rating}}</td>
                            <td>
                                @foreach($adv->advert_cits as $adv_cit)
                                    <div><span style="color:green;">{{$adv_cit->cit->name}}</span>:@if($adv_cit->dogovor == 1) Договорная @else {{$adv_cit->price}} - {{$adv_cit->price_two}} @endif</div>
                                @endforeach
                            </td>
                            <td>
                                @foreach($adv->contractor->phones as $phone)
                                    <div>{{$phone->phone}}</div>
                                @endforeach
                            </td>
                            <td>@if($adv->advert_stat_id == 1) <span style="color:green;">{{$adv->advert_stat->name}}</span> @else <span style="color:red;">{{$adv->advert_stat->name}}</span> @endif</td>
                            <td style=" width:40px; text-align: center;">
                                <a style="" class="btn btn-danger" title="Удалить заявку" href="{{secure_url('admin/requests/basket/delete_advert/'.$basket->id.'?delete_adverts='.$adv->id)}}"><i class="fa fa-trash-o"></i></a>
                            </td>
                            <td><input type="checkbox" class="delete_advert" name='delete_adverts[]' value="{{$adv->id}}"></td>
                        </tr>
                            <?php  $count++; ?>
                        @endforeach
                    </table>
                        <!-- Кнопка активации -->
                        <button class="btn btn-danger" style="float:right; " type="submit"><i class="fa fa-trash-o"></i> Удалить выделенные</button>
                        <a style="float:right; margin-right:10px;" href="#modal1" data-toggle="modal" class="btn1 btn btn-success"><i class="fa fa-plus"></i>Добавить объявление</a>
                    </form>
                    <!-- Модальное окно -->
                    <div id="modal1" class="modal fade">
                        <div style="width: 700px;" class="modal-dialog">
                            <div class="modal-content">
                                <!-- Заголовок модального окна -->
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title">Добавление объявления:</h4>
                                </div>
                                <!-- Основное содержимое модального окна -->
                                <div class="modal-body">
                                    <p>Введите в поиск наименование объявления</p>
                                    <input type="text" id="name_search"><br>
                                    <button id="go_search" class="btn btn-info"><i class="fa fa-binoculars"></i> Найти</button>
                                    <div id="adverts_div"></div>
                                </div>
                                <!-- Футер модального окна -->
                                <div class="modal-footer">
                                    <div class="added_adverts"></div>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                                    <button type="button" id="sent_to_server" class="btn ui primary button">Сохранить изменения</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($combo_requests->count())
                        @foreach($combo_requests as $com_req)
                            @foreach($com_req->combo_cit->combo_categors as $combo_categor)
                                <div id="modal-{{$combo_categor->id}}" class="modal fade">
                                    <div class="modal-dialog" style="width:800px;">
                                        <div class="modal-content">
                                            <!-- Заголовок модального окна -->
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title">Изменение категории: {{$combo_categor->advert_categor->name}}</h4>
                                            </div>
                                            <!-- Основное содержимое модального окна -->
                                            <div class="col-xs-12 modal-body">
                                                <div class="geted_cities">
                                                    @foreach($combo_categor->adverts as $advert)
                                                        <div id="minadv-{{$advert->id}}" class="col-xs-12 col-sm-4 minadvdiv-{{$combo_categor->id}}" style="padding-right: 0;">
                                                            <div class="ui card">
                                                                <div class="blurring dimmable image">
                                                                    <img class="minadvimg-{{$advert->id}}" src="{{secure_asset($advert->photo_main())}}" alt="">
                                                                </div>
                                                                <div class="content">
                                                                    <div class="header text-center">{{$advert->name}}</div>
                                                                </div>
                                                                <div class="extra content">
                                                                    <span style="float: left;"><i class="unhide icon"></i> {{$advert->views}} </span>
                                                                    <span style="float: right;"><i class="star icon"></i> {{$advert->rating}} </span>
                                                                </div>
                                                                <div class="extra content">
                                                                    <div class="ui two buttons">
                                                                        <span id="take-{{$advert->id}}-{{$combo_categor->id}}-{{$com_req->id}}" class=" ui basic teal button take_adv">Выбрать</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <!-- Футер модального окна -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                                                <button type="button" id="save-{{$combo_categor->id}}" data-dismiss="modal" class="btn ui primary button save_adv">Сохранить изменения</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @foreach($combo_categor->adverts as $advert)

                                @endforeach
                                <?php $count++; ?>
                            @endforeach
                        @endforeach
                    @endif

                    <script type="text/javascript">

                        function isNumeric(n) {
                            return !isNaN(parseFloat(n)) && isFinite(n);
                        }

                        function checkpoints(){
                            $('#delete_adverts_main').on('change', function(){
                                $('.delete_advert').prop("checked", this.checked);
                            });
                        }

                        checkpoints();

                        function edit_combo()
                        {
                            var take_advert_id_last;
                            var take_advert_id_new;
                            var take_categor_id;
                            var take_combo_request;

                            $('.change_adv').on('click', function(){
                                var id = $(this).attr('id');
                                id = id.split('-');
                                take_advert_id_last = id[1];
                                take_categor_id = id[2];
                                take_combo_request = id[3];
                                console.log('Ид объяв было' + take_advert_id_last);
                                console.log('Ид категории было ' + take_categor_id);
                                console.log('Ид combo-req ' + take_combo_request);
                            });

                            $('.take_adv').on('click', function(){
                                var id = $(this).attr('id');
                                id = id.split('-');
                                take_advert_id_new = id[1];
                                take_categor_id = id[2];
                                take_combo_request = id[3];
                                console.log('Ид объяв будет ' + take_advert_id_new);
                                console.log('Ид категории будет ' + take_categor_id);
                                console.log('Ид combo-req ' + take_combo_request);
                                $('.take_adv').removeClass('activeTakeAdv');
                                $(this).addClass('activeTakeAdv');
                            });

                            $('.save_adv').on('click', function(){
                                if(take_advert_id_last && take_advert_id_new && take_categor_id && take_combo_request)
                                {
                                    $.ajax({
                                        url: '/admin/requests/basket/edit_combo_adverts/' + take_combo_request,
                                        type: "POST",
                                        headers: {
                                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        data:
                                        {
                                            "advert_last" : take_advert_id_last,
                                            "advert_new" : take_advert_id_new,
                                            "categor_id" :take_categor_id
                                        },
                                        success:function(data)
                                        {
                                            if(data)
                                            {
                                                $('#td-' + take_advert_id_last + '-2').html('<a href="/advert/' + data.id +'">' + data.name +'</a>');
                                                $('#change-' + take_advert_id_last + '-' + take_categor_id + '-' + take_combo_request).attr('id', 'change-' + data.id + '-' + take_categor_id + '-' + take_combo_request);
                                                $('#modal' + take_categor_id).modal('hide');
                                            }
                                        },
                                        error:function()
                                        {
                                            $('#modal' + take_categor_id).modal('hide');
                                            alert('Сервер не отвечает, попробуйте позже');
                                        }
                                    });
                                }
                            });

                            $('.modal').on('hidden.bs.modal', function() {
                                take_advert_id_last = undefined;
                                take_advert_id_new = undefined;
                                take_categor_id = undefined;
                                take_combo_request = undefined;
                            });


                        }

                        edit_combo();

                        function delete_combo()
                        {
                            $('.delete_combo').on('click', function(){
                                var id = $(this).attr('id');
                                var combo_req = id.split('-');
                                combo_req = combo_req[1];
                                if(combo_req)
                                {
                                    var check = confirm('Вы действительно хотите удалить пакет ' + $('#namecomboreq-' + combo_req).html() + 'из заказа?')
                                    if(check)
                                    {
                                        $.ajax({
                                            url: '/admin/requests/basket/delete_combo/' + combo_req,
                                            type: "GET",
                                            headers: {
                                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            success:function(data) {
                                                if(data == 'good')
                                                {
                                                    $('#com_req-' + combo_req).remove();
                                                }
                                            }
                                        });
                                    }
                                }
                            });
                        }

                        delete_combo();

                        function ajax_add_adverts(){

                            var adder = {};
                            var render = "";
                            var added_adve = $('.added_adverts');


                            function go_delete(){
                                $('.delete_added').on('click', function(){

                                    var my_id1 = $(this).attr('id');
                                    my_id1 = my_id1.split('-');
                                    my_id1 = my_id1[1];

                                    delete adder[my_id1];

                                    $('#added-' + my_id1).remove();

                                });
                            }


                            function go_add() {

                                $('.go_adder').on('click', function(){

                                    var my_name = $(this).attr('data-name');
                                    var my_id = $(this).attr('id');
                                    my_id = my_id.split('-');
                                    my_id = my_id[1];


                                    if(!(my_id in adder))
                                    {
                                        added_adve.append("<span class='added_advert_ajax' id='added-" + my_id + "'>" + my_name + "<span id='deladded-" + my_id + "' class='delete_added'>X</span><span>");
                                    }

                                    adder[my_id] = my_name;

                                    go_delete();
                                });
                            }




                            $('#go_search').on('click', function(){

                                $.ajax({
                                    url: "/services/get_adverts",
                                    type: "POST",
                                    headers: {
                                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    data: {'name_search' : $('#name_search').val()},
                                    success:function(data){

                                        render = "<table class='table table-striped table-bordered table-hover table-condensed mytabler'>";
                                        render = render + "<th>Описание</th><th style='width:50px;'>Города</th><th style='width:30px;'>Функции</th>";


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
                                                "<td><div><span class='adv_name'>" + item.name + "</span><span style='color:" + need_color + ";' class='adv_status'>" + item.advert_stat.name + "</span><span class='adv_categor'>" + item.advert_categor.name + "</span></div><div class='descrip_style'><span class='adv_descri'>" + item.description + "</span></div></td>" +
                                                "<td>" + cities + "</td>" +
                                                "<td><button id='adder-" + item.id + "' class='btn btn-success go_adder' data-name='" + item.name + "'><i class=' fa fa-plus'></i></button></td> ";
                                            render = render + "</tr>";
                                        });
                                        render = render + "</table>";
                                        $('#adverts_div').html(render);
                                        go_add();
                                    },
                                    error:function(a,b){
                                        console.log(a + " gr " + b);
                                    }
                                });
                            });

                            $('#sent_to_server').on('click', function(){

                                var json_to_server = JSON.stringify(adder);
                                var adverts = [];
                                var bask_id = $('#basket_id').html();
                                for (var advert in adder)
                                {
                                    if(isNumeric(advert))
                                    {
                                        adverts[advert] = adder[advert];
                                    }
                                }
                                console.log(adverts);
                                $.ajax({
                                    url: "/admin/requests/basket/save_adverts/"+bask_id,
                                    type: "POST",
                                    headers: {
                                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    data: {"adverts" : adverts},
                                    success:function(data) {
                                        var render2 = '';
                                        var my_co = $('th.counter_big').length;
                                        data.forEach(function(advert, i, data){
                                            my_co++;
                                            var phones = "";
                                            var advert_cits = "";
                                            var need_color = (advert.advert_stat_id == 1) ? "green" : "red" ;
                                            advert.contractor.phones.forEach(function(ph)
                                            {
                                                //phones = phones + "<span style='color:red;'>" + ph.phone + "</span> : " + ""
                                                phones = phones + "<div>" + ph.phone + "</div>";
                                            });

                                            advert.advert_cits.forEach(function(adv_c){
                                                var dop  = (adv_c.dogovor == 1) ? "Договорная" : adv_c.price + " - " + adv_c.price_two;
                                                advert_cits = advert_cits + "<div><span style='color:green;'>" + adv_c.cit.name + "</span> " + dop + "</div>";
                                            });


                                            render2 = render2 + "<tr>" +
                                                "<td>" + my_co + "</td>"+
                                                "<td><a href='/advert/"+ advert.id +"'>" + advert.name + "</a></td>"+
                                                "<td>" + advert.advert_categor.name + "</td>"+
                                                "<td>" + advert.rating + "</td>"+
                                                "<td>" + advert_cits + "</td>"+
                                                "<td>" + phones + "</td>" +
                                                "<td><span style='color:" + need_color + ";'>" + advert.advert_stat.name + "</span></td>" +
                                                "<td style='width:40px; text-align: center;'>" + "<a style='' class='btn btn-danger' title='Удалить заявку' href='admin/requests/basket/delete_advert/" + bask_id + "?delete_adverts=" + advert.id +"'><i class='fa fa-trash-o'></i></a>"+
                                                "<td><input type='checkbox' class='delete_advert' name='delete_adverts[]' value='"+ advert.id +"'></td>" +
                                                "</tr>";
                                        });
                                        $('table.main_table').append(render2);
                                        adder = {};
                                        render = "";
                                    },
                                    errors:function(a,b) { alert('Сервер не отвечает');}
                                });



                            })

                        }

                        ajax_add_adverts();



                    </script>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
