@extends('layouts.app')

@section('content')

    <div class="oneHalfBody text-center center-block">
        <div class="ui pointing below big teal label margin-top-always">Наши предложения</div>
        <div class="ui stackable five column grid margin top always">
            @foreach($combos as $combo)
                <div class="column">
                    <div class="ui {{$combo->name_eng}} segment">
                        <h2 class="ui top attached block {{$combo->name_eng}} header"
                            style="margin-right: -1rem; margin-left: -1rem; margin-top: -1rem;">
                            <img alt="{{$combo->name_eng}}" src="{{secure_asset($combo->photo_path)}}"
                                 style="position: absolute; left: -13px; top: -13px; width: 3.5em;">
                            <div class="content">
                                {{$combo->name}}
                                <div class="sub header {{$combo->name_eng}}">{{$combo->price}} ТГ</div>
                            </div>
                        </h2>
                        <ul class="text-left {{$combo->name_eng}}">
                            @foreach($combo->combo_cits as $cit)
                                @foreach($cit->categories as $categ)
                                    <li>{{$categ->name}}</li>
                                @endforeach
                            @endforeach
                        </ul>
                        @foreach($combo->combo_cits as $cit2)
                            <a href="{{secure_url('combo/'.$combo->id.'/'.$cit2->id)}}"
                               class="ui {{$combo->name_eng}} button">
                                Подробнее
                            </a>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        <div class="ui pointing below big teal label margin-top-always">Каталог категорий</div>
        <div class="ui stackable six column raised segment grid" id="categories">
            @foreach($categories as $serv)
                <a class="column ui small image"
                   href="{{secure_url('/services/filter?category='.$serv->id.'&city='.$nowCity->id)}}">
                    <img src="{{secure_asset('images/icons/'.$serv->name_eng.'.png')}}" alt="" class="center-block"
                         style="border-radius: 2.285714rem;">
                </a>
            @endforeach
        </div>
    </div>

@endsection

