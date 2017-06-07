@extends('layouts.app')


@section('content')
    <div class="body text-center">
        <form class="ui stackable pointing menu" action="{{secure_url('services/filter')}}" method="GET">
            <div class="active item">
                <i class="teal tasks icon"></i>
            </div>
            <div class="item">
                <div class="ui icon input">
                    <input type="text" placeholder="Поиск" name="search_name" value="{{$search_name}}">
                    <i class="teal search link icon"></i>
                </div>
            </div>
            <div class="item">
                <div class="ui labeled input">
                    <div class="ui teal label">
                        до
                    </div>
                    <input type="text" placeholder="Цена до" name="price" value="{{$price}}">
                </div>
            </div>
            <div class="item">
                <select class="fluid ui search dropdown center block" name="category">
                    <option value="">Выбрать категорию</option>
                    <option value="0">Все категории</option>
                    @foreach($categories as $categ)
                        @if($categ->id == $category_filter)
                            <option selected="selected" value="{{$categ->id}}">{{$categ->name}}</option>
                        @else
                            <option value="{{$categ->id}}">{{$categ->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="item">
                <select class="fluid ui search dropdown center block" name="city">
                    <option value="">Выбрать город</option>
                    <option value="0">Все города</option>
                    @foreach($cities as $cit_one)
                        @if($cit_one->id == $city_filter)
                            <option selected="selected"
                                    value="{{$cit_one->id}}">{{$cit_one->name}}</option>
                        @else
                            <option value="{{$cit_one->id}}">{{$cit_one->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="item">
                <select name="sort" id="" class="fluid ui search dropdown center block">
                    @foreach($sort_list as $key=>$value_sort)
                        @if($key == $sort_by)
                            <option selected value="{{$key}}">{{$value_sort}}</option>
                        @else
                            <option value="{{$key}}">{{$value_sort}}</option>
                        @endif

                    @endforeach
                </select>
            </div>
            <div class="item">
                <button class="fluid ui primary button">
                    Поиск
                </button>
            </div>
            <div class="item">
                <a href="{{secure_url('services/filter?search_name=&price=&category=0&city=0&sort=1')}}"
                   class="fluid ui reset button">Очистить</a>
            </div>
        </form>
        <div class="ui special four stackable cards margin top always">
            @foreach($adverts as $advert)
                <div class="card">
                    <div class="blurring dimmable image">
                        <div class="ui dimmer">
                            <div class="content">
                                <div class="center">
                                    <div id="{{$advert->id}}" class="ui inverted button buy-btn">Добавить в
                                        корзину
                                    </div>
                                    <a href="{{url('/advert/'.$advert->id.'?city='.$city_filter)}}"
                                       class="ui primary button margin top always">Подробнее</a>
                                </div>
                            </div>
                        </div>
                        @if($advert->photos->first())
                            <img src="{{secure_asset('upload/begests/thumbs/'.$advert->photos->first()['name'].'.'.$advert->photos->first()['ext'])}}"
                                 alt="{{$advert->name}}" title="{{$advert->name}}">
                        @else
                            <img src="{{secure_asset('images/no-avatar.png')}}" alt="{{$advert->name}}"
                                 title="{{$advert->name}}">
                        @endif

                    </div>
                    <div class="floating ui teal label" style="top: 0;right:0;left: 80%; z-index:0;">
                        <i class="unhide icon"></i>{{$advert->views}}
                    </div>
                    <div class="content">
                        <a href="{{url('/advert/'.$advert->id)}}" class="header">{{$advert->name}}</a>
                        <div class="meta">
                            <a href="{{url('/services/filter?category='.$advert->advert_categor->id.'&city='.$city_filter)}}">{{$advert->advert_categor->name}}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{$adverts->appends(['sort' => $sort_by, 'city' => $city_filter, 'category' => $category_filter, 'search_name' => $search_name, 'price' => $price])->links()}}
    </div>
@endsection

