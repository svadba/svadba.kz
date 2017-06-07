@extends('layouts.app')


@section('content')
    <div class="body">
        <div class="ui stackable grid">
            <div class="eight wide tablet four wide computer column">
                @if(Auth::check())
                    <div class="ui card" style="margin-left: auto; margin-right: auto;">
                        <a class="image" href="{{secure_url('/home')}}">
                            @if(Auth::user()->contractors()->first()['ava_path'])
                                <img src="{{secure_asset(Auth::user()->contractors()->first()['ava_path'])}}"
                                     alt="">
                            @else
                                <img src="{{secure_asset('images/no-avatar.png')}}" alt="">
                            @endif
                        </a>
                        <div class="content">
                            <a class="header" href="{{secure_url('/home')}}">{{Auth::user()->name}}</a>
                            <div class="meta">
                                <span class="date">Создан в 09.2014</span>
                            </div>
                        </div>
                        <div class="extra content">
                            <span class="right floated">Объявлений (2)</span>
                            <span>
                                    <div class="ui heart rating" data-rating="1" data-max-rating="5"></div>
                                </span>
                        </div>
                        <a href="{{secure_url('/home')}}"
                           class="ui labeled icon bottom attached button text center">
                            <i class="right arrow icon"></i>
                            Личный кабинет
                        </a>
                    </div>
                @else
                    <div class="ui teal pointing below label">
                        Каталог категорий
                    </div>
                    <div class="ui raised segment"
                         style="max-height: 500px; overflow-y:scroll;box-shadow: 0 0 0 1px #00B5AD inset!important;margin-top:0;">
                        @foreach($sort_adverts as $sort)
                            <a href="{{secure_url('/services/filter?category='.$sort->id)}}" class="ui label"
                               style="background-color:transparent;">
                                <img class="ui right spaced image"
                                     src="{{secure_asset('images/categoryIcons/'.$sort->id.'.png')}}">
                                {{$sort->name}} ({{$sort->adverts_count}})
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="eight wide computer column">
                <form method="GET" action="{{secure_url('/city/by_id')}}" class="ui form">
                    <div class="field">
                        {{csrf_field()}}
                        <div class="ui teal pointing below label">
                            Выберите Ваш город
                        </div>
                        <div class="ui action input">
                            <select name="city" id="cities" class="fluid ui search dropdown">
                                @foreach($cities as $cit)
                                    <option value="{{$cit->id}}">{{$cit->name}}</option>
                                @endforeach
                                <option value="16">Артисты Казахстана</option>
                                <option value="17">Артисты СНГ</option>
                                <option value="18">Артисты Мира</option>
                            </select>
                            <button class="ui teal right labeled icon button">
                                <i class="location arrow icon"></i>Выбрать
                            </button>
                        </div>
                    </div>
                </form>
                <div class="ui raised segment">
                    <video autoplay="" loop="" muted="">
                        <source type="video/mp4" src="{{secure_asset('videos/mainVideo.mp4')}}">
                    </video>
                </div>
            </div>
            <div class="sixteen wide tablet four wide computer column text center">
                <div class="ui teal pointing below label">
                    Вход/Регистрация для специалистов
                </div>
                <a href="{{secure_asset('login')}}" class="ui basic primary button" style="width: 47.5%;"><i
                            class="sign in icon"></i>Вход</a>
                <a href="{{secure_asset('register')}}" class="ui basic positive button"
                   style="width: 47.5%;"> <i class="plus icon"></i>Регистрация</a>
                <h1 class="ui teal top attached header margin top always">
                    Центр свадебной индустрии
                    <div class="sub header">
                        удобный сервис для подготовки к свадьбе! На нашем Республиканском портале Вы найдёте все
                        необходимое для вашей свадьбы.
                    </div>
                </h1>
                <div class="ui attached center aligned tall stacked segment">
                    <div class="ui tiny images">
                        <a href="//www.facebook.com/Svadbakz-1511652225566976/" target="_blank">
                            <img src="{{secure_asset('images/icons/fb.png')}}" alt="fb"
                                 class="ui bordered circular image" style="width:66px;"></a>
                        <a href="//www.instagram.com/www_svadba_kz/" target="_blank">
                            <img src="{{secure_asset('images/icons/inst.png')}}" alt="inst"
                                 class="ui bordered circular image" style="width:66px;"></a>
                        <a href="//vk.com/svadbakz2017" target="_blank">
                            <img src="{{secure_asset('images/icons/vk.png')}}" alt="vk"
                                 class="ui bordered circular image" style="width:66px;"></a>
                        <a href="//www.youtube.com/channel/UCuqcno-2cTI49tl_RqVswTw" target="_blank">
                            <img src="{{secure_asset('images/icons/yout.png')}}" alt="yout"
                                 class="ui bordered circular image" style="width:66px;"></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="ui steps stackable four column grid text center margin top always" style="margin: 0;">
            <a href="#cities-block" class="link step column">
                <div class="content">
                    <img class="ui small image center-block" src="{{secure_asset('images/icons/city.png')}}" alt="">
                    <div class="title">Выбрать город</div>
                    <div class="description">Выберите Ваш город проживания</div>
                </div>
            </a>
            <a href="#cities-block" class="link step column">
                <div class="content">
                    <img class="ui small image center-block" src="{{secure_asset('images/icons/marry.png')}}" alt="">
                    <div class="title">Собрать пакет</div>
                    <div class="description">Соберите пакет свадебных услуг</div>
                </div>
            </a>
            <a href="#cities-block" class="link step column">
                <div class="content">
                    <img class="ui small image center-block" src="{{secure_asset('images/icons/call.png')}}" alt="">
                    <div class="title">Оставить заявку</div>
                    <div class="description">После добавления всех услуг отправьте нам заявку</div>
                </div>
            </a>
            <div class="link step column">
                <div class="content">
                    <img class="ui small image center-block" src="{{secure_asset('images/icons/operator.png')}}" alt="">
                    <div class="title">Бесплатная консультация</div>
                    <div class="description">Если у вас возникнут трудности, нажмите кнопку звонок</div>
                </div>
            </div>
        </div>
        <a href="{{secure_url('bakyt')}}" class="ui fluid bordered image margin top always">
            <img src="{{secure_asset('images/main_page-ad.png')}}" alt="bakyt">
        </a>
        <div class="text center">
            <div class="ui teal pointing below big label margin top always">
                <i class="marker icon"></i>
                Выберите Ваш город
            </div>
            <div class="ui stackable six column grid" id="cities-block">
                @foreach($cities as $cit)
                    <div class="column">
                        <a href="{{secure_url('cities/'.$cit->name_eng)}}"
                           class="fluid ui circular bordered rotate left reveal image">
                            <img alt="{{$cit->name_eng}}" src="{{secure_asset('images/icons/'.$cit->name_eng.'.png')}}"
                                 class="visible content">
                            <img alt="{{$cit->name_eng.'-flo'}}"
                                 src="{{secure_asset('images/icons/'.$cit->name_eng.'-flo.png')}}"
                                 class="hidden content">
                        </a>
                    </div>
                @endforeach
                <div class="column">
                    <a href="{{secure_url('services/filter?search_name=&price=&category=0&city=16&sort=1')}}"
                       class="fluid ui circular bordered rotate left reveal image">
                        <img alt="Artists_of_Kazakhstan"
                             src="{{secure_asset('images/icons/Artists_of_Kazakhstan.png')}}">
                    </a>
                </div>
                <div class="column">
                    <a href="{{secure_url('services/filter?search_name=&price=&category=0&city=17&sort=1')}}"
                       class="fluid ui circular bordered rotate left reveal image">
                        <img alt="Artists_of_Russia" src="{{secure_asset('images/icons/Artists_of_SNG.png')}}">
                    </a>
                </div>
                <div class="column">
                    <a href="{{secure_url('services/filter?search_name=&price=&category=0&city=18&sort=1')}}"
                       class="fluid ui circular bordered rotate left reveal image">
                        <img alt="Artists_of_the_World" src="{{secure_asset('images/icons/Artists_of_the_World.png')}}">
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

