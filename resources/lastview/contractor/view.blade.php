@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 style="font-size:20px; margin-bottom:15px;">Подрядчики</h3>
                    <div>
                        <ul style="margin:5px 0px 10px -35px;">
                        </ul>
                    </div>
                    <a href="{{url('contractors/my')}}" class="btn btn-default">
                        <i class="fa fa-star"></i> Мои подрядчики
                    </a>
                    <a href="{{url('contractors/all')}}" class="btn btn-default">
                        <i class="fa fa-list-ul"></i> Все подрядчики
                    </a>
                    <a href="{{url('contractors/add')}}" class="btn btn-default">
                        <i class="fa fa-plus"></i> Добавить подрядчика
                    </a>
                </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-4">
                                <img src="avatar.gif" class="img-responsive img-thumbnail" alt="Responsive image">
                            </div>
                            <div class="col-xs-8">
                                <table class="table table-bordered table-hover">
                                    <tr><th>ФИО</th><td>{{$contractor->surname}} {{$contractor->name}} {{$contractor->middlename}}</td></tr>
                                    <tr>
                                        <th>Контакты</th>
                                        @foreach($contractor->phones as $phone)
                                            <td>+{{$phone->phone}}</td>
                                        @endforeach
                                    </tr>
                                        
                                    <tr><th>email</th><td>{{$contractor->email}}</td></tr>
                                    <tr><th>Адрес</th><td>{{$contractor->address}}</td></tr>
                                </table>
                                <a href="{{url('adverts/add/'.$contractor->id)}}" type="button" class="btn btn-primary btn-lg btn-block">+ Добавить объявление</a>
                            </div>
                        </div>
                    </div>
                
                <div class="container-fluid">
                    <div class="row">
                        <div class="">
                            <div class="panel panel-default">
                                <div class="panel-body col-sm-12">
                                    <div>
                                    </div>                        
                                    <table class="table table-striped table-bordered table-hover table-condensed" cellspacing='0'>
                                        <tr class="bottom">
                                            <td colspan="9">
                                                <table style="float:right;" class="table table-striped table-bordered table-hover table-condensed">
                                                    <tr>
                                                        <th style="background: #e6e6e6;">№</th>
                                                        <th style="background: #e6e6e6;">Наименование</th>
                                                        <th style="background: #e6e6e6;">Описание</th>
                                                        <th style="background: #e6e6e6;">Категория</th>
                                                        <th style="background: #e6e6e6;">Фото</th>
                                                        <th style="background: #e6e6e6;">Муз. файлы</th>
                                                        <th style="background: #e6e6e6;">Видео файлы</th>
                                                        <th style="background: #e6e6e6;">Статус активности</th>
                                                        <th style="background: #e6e6e6;">Статус опубликованости</th>
                                                        <th style="background: #e6e6e6;">Функции</th>
                                                    </tr>
                                                    <?php  $count = 1; ?>
                                                    @foreach ($contractor->adverts as $adv)
                                                        <tr>
                                                            <td><?php echo  $count ; ?></td>
                                                            <td>{{$adv->name}}</td>
                                                            <td>{{$adv->description}}</td>
                                                            <td>{{$adv->advert_categor->name}}</td>
                                                            <td>{{count($adv->photos)}}</td>
                                                            <td>{{count($adv->musics)}}</td>
                                                            <td>{{count($adv->videos)}}</td>
                                                            <td>{{$adv->advert_stat->name}}</td>
                                                            <td>{{$adv->allow_type->name}}</td>

                                                            <?php  $count++; ?>
                                                            <td style=" width:172px; text-align: right;">
                                                            @if(ServiceMan::canView())
                                                                @if($adv->allow_type->id == 1)
                                                                    <a style="" class="btn btn-info" title="Снять с публикации" href="{{url('/adverts/unallow/'.$adv->id)}}"><i class="fa fa-external-link"></i></a>
                                                                @else
                                                                    <a style="" class="btn btn-info" title="Опубликовать" href="{{url('/adverts/allow/'.$adv->id)}}"><i class="fa fa-external-link"></i></a>
                                                                @endif 
                                                            @endif
                                                                <a style="" class="btn btn-warning" title="Редактировать объявление" href="{{url('adverts/edit/'.$adv->id)}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                                <a style="" class="btn btn-danger" title="Удалить объявление" href="{{url('adverts/delete/'.$adv->id)}}"><i class="fa fa-trash-o"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                        </tr>                  
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
