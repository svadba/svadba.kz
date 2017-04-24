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
                    <a href="{{url('admin/requests/baskets')}}" class="btn btn-default">
                        <i class="fa fa-star"></i> Заявки из корзин
                    </a>
                    <a href="{{url('admin/requests/baskets')}}" class="btn btn-default">
                        <i class="fa fa-list-ul"></i> Заявки из пакетов
                    </a>
                </div>


                <div class="panel-body col-xs-12">
                    @include('common.errors')
                    <table style="font-size:16px; max-width:500px;" class="table table-striped table-bordered table-hover table-condensed">
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
                                <form style="display:inline-block; " method="POST" id="form_tusa" action="{{url('/admin/requests/basket/save_tusa/'.$basket->id)}}">
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
                            <td>@if($basket->ended != 1) <a style="" class="btn btn-success" title="Завершить заявку" href="{{url('admin/requests/basket/set_end/'.$basket->id)}}"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a> @endif</td>
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
                    <h4>Таблица объявлений заказанных клиентом:</h4>
                    <form method="post" action="{{url('admin/requests/basket/delete_adverts/'.$basket->id)}}">
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
                            <td><a href="{{url('advert/'.$adv->id)}}">{{$adv->name}}</a></td>
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
                                <a style="" class="btn btn-danger" title="Удалить заявку" href="{{url('admin/requests/basket/delete_advert/'.$basket->id.'?delete_adverts='.$adv->id)}}"><i class="fa fa-trash-o"></i></a>
                            </td>
                            <td><input type="checkbox" class="delete_advert" name='delete_adverts[]' value="{{$adv->id}}"></td>
                        </tr>
                            <?php  $count++; ?>
                        @endforeach
                    </table>
                        <!-- Кнопка активации -->
                        <button class="btn btn-danger" style="float:right; " type="submit"><i class="fa fa-trash-o"></i> Удалить выделенные</button>
                        <label style="float:right; margin-right:10px;" class="btn1 btn btn-success" for="modal-1"><i class="fa fa-plus"></i>Добавить объявление</label>
                    </form>
                    <!-- Модальное окно -->
                    <div class="modal1">
                        <input class="modal-open1" id="modal-1" type="checkbox" hidden>
                        <div class="modal-wrap1" aria-hidden="true" role="dialog">
                            <label class="modal-overlay1" for="modal-1"></label>
                            <div class="modal-dialog1">
                                <div class="modal-header1">
                                    <h2>Добавление объявления </h2>
                                    <label class="btn-close1" for="modal-1" aria-hidden="true">×</label>
                                </div>
                                <div class="modal-body1">
                                    <p>Введите в поиск наименование объявления</p>
                                    <input type="text" id="name_search"><br>
                                    <button id="go_search" class="btn btn-info"><i class="fa fa-binoculars"></i> Найти</button>
                                    <div id="adverts_div"></div>
                                </div>
                                <div class="modal-footer1">
                                    <div class="added_adverts"></div>
                                    <label id="sent_to_server" class="btn btn-success" for="modal-1"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Добавить</label>
                                </div>
                            </div>
                        </div>
                        <div style="display:none;" class="go_adder"></div><div style="display:none;" class="delete_added"></div>
                    </div>
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
                                                "<td class='photoTD'><img class='adv_img' src='{{'/'}}" + photo + "'></td> " +
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
