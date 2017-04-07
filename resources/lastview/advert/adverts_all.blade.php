@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="">
            <div class="panel panel-default ">
                <div class="panel-heading"><h3 style="font-size:20px; margin-bottom:15px;">Объявления подрядчиков</h3>
                    <div>
                        <ul style="margin:5px 0px 10px -35px;">
                        </ul>
                    </div>
                    <a href="{{url('adverts/my')}}" class="btn btn-default">
                        <i class="fa fa-star"></i> Мои объявления
                    </a>
                    <a href="{{url('adverts/all')}}" class="btn btn-default">
                        <i class="fa fa-list-ul"></i> Все объявления
                    </a>
                </div>
                
                <div class="panel-body col-sm-8">
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
                            </td>
                        </tr>
                        
                         
                    @endforeach
                    </table>
                </div>
                <div id="filter" class="col-md-3">
                    <form action="" method="post" class="search">
                        <input type="search" name="" placeholder="Поиск" class="input" />
                        <input type="submit" name="" value="" class="submit" />
                    </form>
                    <form action="{{url('/adverts/all')}}" method="GET">
                        {{ csrf_field() }}
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
                            <button type="submit" class="btn btn-default">Найти</button>
                    </form>
                </div>
            </div>
            {{$adverts->appends(['sort' => $sort, 'city' => $city, 'category' => $category])->links()}}
        </div>
    </div>
</div>
@endsection
