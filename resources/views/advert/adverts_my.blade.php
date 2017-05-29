@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="">
            <div class="panel panel-default ">
                <div class="panel-heading"><h3 style="font-size:20px; margin-bottom:15px;">Объявления подрядчиков</h3>
                    <div>
                        <ul style="margin:5px 0px 10px -35px;">
                        </ul>
                    </div>
                    <a href="{{secure_url('admin/adverts/my')}}" class="btn btn-default col-xs-6 col-sm-4 col-md-2">
                        <i class="fa fa-star"></i> Мои объявления
                    </a>
                    <a href="{{secure_url('admin/adverts/all')}}" class="btn btn-default col-xs-6 col-sm-4 col-md-2">
                        <i class="fa fa-list-ul"></i> Все объявления
                    </a>
                    <form action="{{secure_url('admin/adverts/my')}}" method="GET" class="search col-xs-2 col-sm-4 col-md-2">
                        <input type="search" name="search_name" placeholder="Поиск" class="input" />
                        <input type="submit" name="" value="" class="submit" />
                    </form>
                    <form action="{{secure_url('admin/adverts/my')}}" method="GET" class="col-xs-12 col-sm-12 col-md-6">
                        {{ csrf_field() }}
                        <div class="col-xs-12 col-sm-12 col-md-5">
                            <h4>Фильтры:</h4>
                            <select class="form-control" name="city" href="#" role="button">
                                <option value="">Города</option>
                                @foreach($cities as $cit)
                                <option value="{{$cit->id}}">{{$cit->name}}</option>
                                @endforeach()
                            </select>
                            <select class="form-control" name="category" href="#" role="button">
                                <option value="">Категории</option>
                                @foreach($categories as $categor)
                                <option value="{{$categor->id}}">{{$categor->name}}</option>
                                @endforeach()
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-5">
                            <h4>Отсортировать по:</h4>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="sort" id="optionsRadios1" value="create" checked>
                                    Дата добавления
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="sort" id="optionsRadios2" value="published">
                                    Дата публикации
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-default col-xs-12 col-sm-12 col-md-2">Найти</button>
                    </form>
                </div>
                
                <div class="panel-body col-xs-12">
                    <h5>Мною добавленные объявления:</h5>
                    <table class="table table-striped table-bordered table-hover table-condensed" cellspacing='0'>
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
                        <?php $count = 1;?>
                        @foreach ($adverts as $adv)
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td>{{str_limit($adv->name,25)}}</td>
                            <td>{!! str_limit($adv->description,100) !!}</td>
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
                                    <a style="" class="btn btn-primary" title="Снять с публикации" href="{{secure_url('admin/adverts/unallow/'.$adv->id)}}"><span class="glyphicon glyphicon-remove" aria-hidden="true"></a>
                                    @else
                                    <a style="" class="btn btn-success" title="Опубликовать" href="{{secure_url('admin/adverts/allow/'.$adv->id)}}"><span class="glyphicon glyphicon-ok" aria-hidden="true"></a>
                                    @endif 
                                @endif
                                <a style="" class="btn btn-warning" title="Редактировать объявление" href="{{secure_url('admin/adverts/edit/'.$adv->id)}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                @if(ServiceMan::canView())
                                    <a style="" class="btn btn-danger" title="Удалить объявление" href="{{secure_url('admin/adverts/delete/'.$adv->id)}}"><i class="fa fa-trash-o"></i></a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            {{$adverts->appends(['sort' => $sort, 'city' => $city, 'category' => $category])->links()}}
        </div>
    </div>
</div>
@endsection
