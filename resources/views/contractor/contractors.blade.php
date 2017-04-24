@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 style="font-size:20px; margin-bottom:15px;">Подрядчики</h3>
                    <div>
                        <ul style="margin:5px 0px 10px -35px;">
                        </ul>
                    </div>
                    <a href="{{url('admin/contractors/my')}}" class="btn btn-default">
                        <i class="fa fa-star"></i> Мои подрядчики
                    </a>
                    <a href="{{url('admin/contractors/all')}}" class="btn btn-default">
                        <i class="fa fa-list-ul"></i> Все подрядчики
                    </a>
                    <a href="{{url('admin/contractors/add')}}" class="btn btn-default">
                        <i class="fa fa-plus"></i> Добавить подрядчика
                    </a>
                </div>
                
                <div class="panel-body">
                    <h5>Мною добавленные подрядчики:</h5>
                    <table class="table table-striped table-bordered table-hover table-condensed" cellspacing='0'>
                        <tr>
                            <th style="background: #d0d0d0;">#</th>
                            <th style="background: #d0d0d0;">Имя</th>
                            <th style="background: #d0d0d0;">Фамилия</th>
                            <th style="background: #d0d0d0;">Отчество</th>
                            <th style="background: #d0d0d0;">Телефон</th>
                            <th style="background: #d0d0d0;">Тип</th>
                            <th style="background: #d0d0d0;">Статус активности</th>
                            <th style="background: #d0d0d0;">Функции</th>
                        </tr>
                    <?php $count = 1;?>
                    @foreach ($contractors as $contr)
                        <tr>
                        
                            <td><?php echo $count; ?></td>
                            <td>{{$contr->name}}</td>
                            <td>{{$contr->surname}}</td>
                            <td>{{$contr->middlename}}</td>
                            <td>
                            @foreach($contr->phones as $phone)
                                {{$phone->phone}}<br/>
                            @endforeach
                            </td>
                            <td>{{$contr->contype->name}}</td>
                            <td>{{$contr->constat->name}}</td>

                            <?php  $count++; ?>
                            <td style="width: 172px; text-align: right;">
                                <a class="btn btn-primary" title="Добавить объявление" href="{{url('admin/adverts/add/'.$contr->id)}}"><i class="fa fa-plus"></i></a>
                                <a class="btn btn-info" title="Открыть подрядчика" href="{{url('admin//contractors/view/'.$contr->id)}}"><i class="fa fa-external-link"></i></a>
                                <a class="btn btn-warning" title="Редактировать подрядчика" href="{{url('admin/contractors/edit/'.$contr->id)}}"><i class="fa fa-pencil"></i></a>
                                <a class="btn btn-danger" title="Удалить подрядчика" href="{{url('admin/contractors/delete/'.$contr->id)}}"><i class="fa fa-trash-o"></i></a>
                            </td>
                           
                        </tr>
                        <tr>
                            <td colspan="9">
                                <table style="float:right; font-size:10px; width:70%;" class="table table-striped table-bordered table-hover table-condensed">
                                    <th style="background: #e6e6e6;">Имя</th>
                                    <th style="background: #e6e6e6;">Описание</th>
                                    <th style="background: #e6e6e6;">Категория</th>
                                    <th style="background: #e6e6e6;">Фото</th>
                                    <th style="background: #e6e6e6;">Муз. файлы</th>
                                    <th style="background: #e6e6e6;">Видео файлы</th>
                                    <th style="background: #e6e6e6;">Статус активности</th>
                                    <th style="background: #e6e6e6;">Статус опубликованости</th>
                                    <th style="background: #e6e6e6;">Функции</th>
                                    @foreach($contr->adverts as $adv)
                                    <tr>
                                        <td>{{str_limit($adv->name, 20)}}</td>
                                        <td>{{str_limit($adv->description,60)}}</td>
                                        <td>{{$adv->advert_categor->name}}</td>
                                        <td>{{count($adv->photos)}}</td>
                                        <td>{{count($adv->musics)}}</td>
                                        <td>{{count($adv->videos)}}</td>
                                        <td>{{$adv->advert_stat->name}}</td>
                                        <td>{{$adv->allow_type->name}}</td>
                                        <td style=" width:80px; text-align: right;">
                                        @if(ServiceMan::canView())
                                            @if($adv->allow_type->id == 1)
                                                <a style="padding:0px 3px; font-size:14px" class="btn btn-primary" title="Снять с публикации" href="{{url('admin/adverts/unallow/'.$adv->id)}}"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
                                            @else
                                                <a style="padding:0px 3px; font-size:14px" class="btn btn-success" title="Опубликовать" href="{{url('admin/adverts/allow/'.$adv->id)}}"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a>
                                            @endif 
                                        @endif
                                            <a style="padding:0px 3px; font-size:14px;" class="btn btn-warning" title="Редактировать объявление" href="{{url('admin/adverts/edit/'.$adv->id)}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            <a style="padding:0px 3px; font-size:14px;" class="btn btn-danger" title="Удалить объявление" href="{{url('admin/adverts/delete/'.$adv->id)}}"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                
                                </table>
                            </td>
                        </tr>  
                    @endforeach
                    </table>
                </div>
                {{$contractors->links()}}
            </div>
        </div>
    </div>
</div>
@endsection
