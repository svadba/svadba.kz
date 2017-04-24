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
                    <form style="margin-top:10px; left:-15px;" action="{{url('')}}" method="GET" class="search col-sm-8">
                        <input type="search" name="search_name" placeholder="Поиск" class="input" />
                        <input type="submit" name="" value="" class="submit" />
                    </form>
                </div>


                <div class="panel-body col-xs-12">
                    @include('common.errors')
                    <table style="font-size:16px; max-width:500px;" class="table table-striped table-bordered table-hover table-condensed">
                        <tr>
                            <td>Заявка №</td>
                            <td style="color:darkblue;">{{$basket->id}}</td>
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
                    <form method="post" action="{{url('admin/requests/basket/delete_adv_many/'.$basket->id)}}">
                    <table class="table table-striped table-bordered table-hover table-condensed" cellspacing='0'>
                        <tr>
                            <th style="background: #e6e6e6;">№</th>
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
                                <a style="" class="btn btn-danger" title="Удалить заявку" href="{{url('admin/requests/basket/delete_adv_one/'.$basket->id.'?delete_adverts='.$adv->id)}}"><i class="fa fa-trash-o"></i></a>

                            </td>
                            <td><input type="checkbox" class="delete_advert" name='delete_adverts[]' value="{{$adv->id}}"></td>
                        </tr>
                            <?php  $count++; ?>
                        @endforeach
                    </table>
                        <button class="btn btn-danger" style="float:right;" type="submit"><i class="fa fa-trash-o"></i>Удалить выделенные</button>
                    </form>
                    <script type="text/javascript">
                        function checkpoints(){
                            $('#delete_adverts_main').on('change', function(){
                                if($('#delete_adverts_main').checked)
                                {
                                    $('.delete_advert').attr('checked', 'checked');
                                }
                                else
                                {
                                    $('.delete_advert').attr('checked', '');
                                }
                            });
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
