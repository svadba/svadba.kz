@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="">
            <div class="panel panel-default ">
                <div class="panel-heading"><h3 style="font-size:20px; margin-bottom:15px;">Заявки от клиентов</h3>
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
                    <h4>Заявки из корзин</h4>
                    <table class="table table-striped table-bordered table-hover table-condensed" cellspacing='0'>
                        <tr>
                            <th style="background: #e6e6e6;">№</th>
                            <th style="background: #e6e6e6;">Имя</th>
                            <th style="background: #e6e6e6;">Город</th>
                            <th style="background: #e6e6e6;">Телефон</th>
                            <th style="background: #e6e6e6;">Электронный адрес</th>
                            <th style="background: #e6e6e6;">Заказ</th>
                            <th style="background: #e6e6e6;">Дата создания</th>
                            <th style="background: #e6e6e6;">Дата обработки</th>
                            <th style="background: #e6e6e6;">Функции</th>
                        </tr>
                        <?php $count = 1;?>
                        @foreach ($baskets as $bask)
                        <tr id="tr-{{$bask->id}}">
                            <td><?php echo $bask->id; ?></td>
                            <td>{{$bask->name}}</td>
                            <td>{{$bask->cit->name}}</td>
                            <td>{{$bask->phone}}</td>
                            <td>{{$bask->email}}</td>
                            <td>
                                @if($bask->combo_requests->count())
                                    @foreach($bask->combo_requests as $com_req)
                                        <p>Пакет: {{$com_req->combo->name}}</p>
                                    @endforeach
                                @else
                                    <p>Пакетов не выбрано!</p>
                                @endif
                                <p><span style="color:green;">Дополнительно:</span>{{$bask->count_advert()}} объяв.</p>


                            </td>
                            <td>{{$bask->created_at}}</td>
                            <td>@if($bask->ended_at) <span style="color:green">Завершена - {{$bask->ended_at}}</span> @else <span style="color:red;">Не обработана</span> @endif</td>
                            <?php  $count++; ?>
                            <td style=" width:172px; text-align: right;">
                                <a style="" class="btn btn-info" title="Открыть заявку" href="{{url('admin/requests/basket/'.$bask->id)}}"><i class="fa fa-external-link" aria-hidden="true"></i></a>
                                @if($bask->ended == 1)
                                    <a style="" class="btn btn-primary" title="Снять статус выполнено" href="{{url('admin/requests/basket/set_no_end/'.$bask->id)}}"><span class="glyphicon glyphicon-remove" aria-hidden="true"></a>
                                @else
                                    <a style="" class="btn btn-success" title=" Установить статус выполнено" href="{{url('admin/requests/basket/set_end/'.$bask->id)}}"><span class="glyphicon glyphicon-ok" aria-hidden="true"></a>
                                @endif
                                @if(ServiceMan::canView())
                                <span  id="delbask-{{$bask->id}}" class="btn btn-danger delete_bask" title="Удалить заявку" ><i class="fa fa-trash-o"></i></span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            {{$baskets->links()}}
        </div>
    </div>
</div>
    <script type="text/javascript">
        function del_bask()
        {
            $('.delete_bask').on('click', function(){
                var id = $(this).attr('id');
                var bask_id = id.split('-');
                bask_id = bask_id[1];
                if(bask_id)
                {
                    var check = confirm('Вы действительно хотите удалить заявку № ' + bask_id + '?');
                    if(check)
                    {
                        $.ajax({
                            url:'/admin/requests/basket/delete/'+bask_id,
                            type: "get",
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (data) {
                                if(data == 'good')
                                {
                                    $('#tr-' + bask_id).remove();
                                }
                                else
                                {
                                    alert('Не удалено');
                                }
                            },
                            error: function (a, b) {
                                alert('Сервер не отвечает попробуйте позже!')
                            }
                        });
                    }
                }
            });
        }
        del_bask();
    </script>
@endsection
