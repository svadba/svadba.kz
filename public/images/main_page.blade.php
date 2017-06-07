@extends('layouts.app')


@section('content')
    <div class="body">
        <div class="ui stackable three column grid">
            <div class="column">
                <div class="ui tiny images">
                    <a href="//www.facebook.com/Svadbakz-1511652225566976/">
                        <img src="{{secure_asset('images/icons/fb.png')}}" alt=""></a>
                    <a href="//www.instagram.com/www_svadba_kz/">
                        <img src="{{secure_asset('images/icons/inst.png')}}" alt=""></a>
                    <a href="//vk.com/svadbakz2017">
                        <img src="{{secure_asset('images/icons/vk.png')}}" alt=""></a>
                    <a href="//www.youtube.com/channel/UCuqcno-2cTI49tl_RqVswTw">
                        <img src="{{secure_asset('images/icons/yout.png')}}" alt=""></a>
                </div>
                <h1 class="ui header">
                    <img alt="logo" src="{{secure_asset('images/clearLogo.png')}}">
                    <div class="content">
                        Центр свадебной индустрии
                        <div class="sub header">
                            организуй свадьбу своей мечты!
                        </div>
                    </div>
                </h1>
                <h2 class="ui header">
                    <img class="ui image" src="{{secure_asset('images/clearLogo.png')}}">
                    <div class="content">
                        Центр свадебной индустрии
                    </div>
                </h2>
            </div>
            <div class="column">
                <div class="col-xs-12 padding">
                    <form method="GET" action="{{secure_url('/city/by_id')}}" class="ui form">
                        <div class="field">
                            {{csrf_field()}}
                            <label>Выберите Ваш город</label>
                            <div class="ui action input">
                                <select name="city" id="cities" class="fluid ui search dropdown">
                                    @foreach($cities as $cit)
                                        <option value="{{$cit->id}}">{{$cit->name}}</option>
                                    @endforeach
                                    <option value="16">Артисты Казахстана</option>
                                    <option value="17">Артисты СНГ</option>
                                    <option value="18">Артисты Мира</option>
                                </select>
                                <button class="ui button">Выбрать</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-xs-12 col-md-9 padding-left-0">
                    <video autoplay="" loop="" muted="">
                        <source type="video/mp4" src="{{secure_asset('videos/main_video.mov')}}">
                    </video>
                </div>
            </div>
            <div class="column">
                <div class="col-xs-12 margin-top-always" style="padding-left: 0; padding-right: 0;">
                    @if(Auth::check())
                        <div class="ui card">
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
                            <a href="{{secure_url('/home')}}" class="ui right labeled icon bottom attached button"
                               style="text-align: center;">
                                <i class="right arrow icon"></i>
                                Личный кабинет
                            </a>
                        </div>
                    @else
                    <!-- Навигационные вкладки -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active checkIn">
                                <a href="#checkIn" aria-controls="checkIn" role="tab"
                                   data-toggle="tab">Регистрация</a>
                            </li>
                            <li role="presentation" class="toComeIn">
                                <a href="#toComeIn" aria-controls="toComeIn" role="tab" data-toggle="tab">Войти</a>
                            </li>
                        </ul>
                        <!-- Вкладки -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="checkIn">
                                <div class="col-xs-12 checkIn">
                                    <h3 class="text-center padding-bottom" style="color: #fff; margin-top: 15px;">
                                        Добавьте
                                        свою
                                        анкету</h3>
                                    <form method="POST" action="{{ secure_url('/register') }}">
                                        {{ csrf_field() }}
                                        <input class="form-control" placeholder="Имя" name="name" type="text">
                                        @if ($errors->has('name'))
                                            <span class="help-block">
							<strong>{{ $errors->first('name') }}</strong>
						</span>
                                        @endif
                                        <input type="email" class="form-control margin-top-always" name="email"
                                               placeholder="Email">
                                        @if ($errors->has('email'))
                                            <span class="help-block">
							<strong>{{ $errors->first('email') }}</strong>
						</span>
                                        @endif
                                        <input type="password" name="password" class="form-control margin-top-always"
                                               placeholder="Пароль">
                                        @if ($errors->has('password'))
                                            <span class="help-block">
							<strong>{{ $errors->first('password') }}</strong>
						</span>
                                        @endif
                                        <button class="btn btn-default btn-lg btn-block"
                                                style="margin-top: 15px; margin-bottom: 15px;"> + Добавить
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="toComeIn">
                                <div class="col-xs-12 toComeIn">
                                    <h3 class="text-center padding-bottom" style="color: #fff; margin-top: 15px;">Личный
                                        кабинет</h3>
                                    <form method="POST" action="{{ secure_url('/login') }}">
                                        {{ csrf_field() }}
                                        <input type="email" class="form-control" name="email"
                                               placeholder="Email">
                                        @if ($errors->has('email'))
                                            <span class="help-block">
							<strong>{{ $errors->first('email') }}</strong>
						</span>
                                        @endif
                                        <input type="password" name="password" class="form-control margin-top-always"
                                               placeholder="Пароль">
                                        @if ($errors->has('password'))
                                            <span class="help-block">
							<strong>{{ $errors->first('password') }}</strong>
						</span>
                                        @endif
                                        <button class="btn btn-default btn-lg btn-block"
                                                style="margin-top: 15px; margin-bottom: 15px;"> Войти
                                        </button>
                                        <a class="btn btn-default btn-lg btn-block"
                                           href="{{ secure_url('/password/reset') }}"
                                           style="margin-top: 15px; margin-bottom: 15px;">Забыли
                                            пароль?</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <a href="{{secure_url('bakyt')}}">
                <img src="{{secure_asset('images/main_page-ad.png')}}" alt="" class="img-responsive ad">
            </a>
        </div>
        <div class="col-xs-12 margin-top-always">
            <div class="ui steps center-block text-center">
                <a href="#cities-block" class="link step col-xs-12 col-md-3 xs-padding-right-left-hidden">
                    <div class="content">
                        <img class="center-block" src="{{secure_asset('images/icons/city.png')}}" alt=""
                             style="width:66%;">
                        <div class="title">Выбрать город</div>
                        <div class="description">Выберите Ваш город проживания</div>
                    </div>
                </a>
                <a href="#cities-block" class="link step col-xs-12 col-md-3 xs-padding-right-left-hidden">
                    <div class="content">
                        <img class="center-block" src="{{secure_asset('images/icons/marry.png')}}" alt=""
                             style="width:66%;">
                        <div class="title">Собрать пакет</div>
                        <div class="description">Соберите пакет свадебных услуг</div>
                    </div>
                </a>
                <a href="#cities-block" class="link step col-xs-12 col-md-3 xs-padding-right-left-hidden">
                    <div class="content">
                        <img class="center-block" src="{{secure_asset('images/icons/call.png')}}" alt=""
                             style="width:66%;">
                        <div class="title">Оставить заявку</div>
                        <div class="description">После добавления всех услуг отправьте нам заявку</div>
                    </div>
                </a>
                <div class="link step col-xs-12 col-md-3 xs-padding-right-left-hidden">
                    <div class="content">
                        <img class="center-block" src="{{secure_asset('images/icons/operator.png')}}" alt=""
                             style="width:66%;">
                        <div class="title">Бесплатная консультация</div>
                        <div class="description">Если у вас возникнут трудности, нажмите кнопку звонок</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 cities-block" id="cities-block">
            <h2 class="text-center margin-top-always">Выберите Ваш город</h2>
            @foreach($cities as $cit)
                <div class="col-xs-12 col-md-2">
                    <a href="{{secure_url('cities/'.$cit->name_eng)}}"
                       class="center-block ui small circular rotate left reveal image">
                        <img alt="{{$cit->name_eng}}" src="{{secure_asset('images/icons/'.$cit->name_eng.'.png')}}"
                             class="visible content">
                        <img alt="{{$cit->name_eng.'-flo'}}"
                             src="{{secure_asset('images/icons/'.$cit->name_eng.'-flo.png')}}"
                             class="hidden content">
                    </a>
                </div>
            @endforeach
            <div class="col-xs-12 col-md-2 text-center">
                <a href="{{secure_url('cities/Artists_of_Kazakhstan')}}"
                   class="center-block ui small circular rotate left reveal image">
                    <img alt="Artists_of_Kazakhstan" src="{{secure_asset('images/icons/Artists_of_Kazakhstan.png')}}">
                </a>
            </div>
            <div class="col-xs-12 col-md-2 text-center">
                <a href="{{secure_url('cities/Artists_of_Russia')}}"
                   class="center-block ui small circular rotate left reveal image">
                    <img alt="Artists_of_Russia" src="{{secure_asset('images/icons/Artists_of_Russia.png')}}">
                </a>
            </div>
            <div class="col-xs-12 col-md-2 text-center">
                <a href="{{secure_url('cities/Artists_of_the_World')}}"
                   class="center-block ui small circular rotate left reveal image">
                    <img alt="Artists_of_the_World" src="{{secure_asset('images/icons/Artists_of_the_World.png')}}">
                </a>
            </div>
        </div>
    </div>
@endsection

