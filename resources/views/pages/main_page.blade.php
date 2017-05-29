@extends('layouts.app')


@section('content')
    <div class="row body">
        <div class="col-xs-12 padding-bottom">
            <div class="col-xs-12 col-md-9 xs-padding-right-left-hidden">
                <div class="col-xs-12 padding">
                    <div class="col-xs-12 col-md-3">
                        <h2 class="text-center">Ваш город:</h2>
                    </div>
                    <form method="GET" action="{{secure_url('/city/by_id')}}">
                        <div class="col-xs-12 col-md-9 input-group">
                            {{csrf_field()}}
                            <select name="city" id="cities" class="form-control">
                                @foreach($cities as $cit)
                                    <option value="{{$cit->id}}">{{$cit->name}}</option>
                                @endforeach
                                <option value="16">Артисты Казахстана</option>
                                <option value="17">Артисты России</option>
                                <option value="18">Артисты Мира</option>
                            </select>
                            <span class="input-group-btn">
							<button class="btn btn-default" type="submit">Выбрать!</button>
						</span>
                        </div>
                    </form>
                </div>
                <div class="col-xs-12 col-md-3 padding-right-0 text-center">
                    <h1 style="font-size: 16px;">Центр свадебной индустрии</h1> - удобный сервис для подготовки к
                    свадьбе! На нашем Республиканском портале Вы найдёте все необходимое для вашей свадьбы.
                    <a href="#">
                        <img src="{{secure_asset('videos/main_page-ad.gif')}}" alt=""
                             class="img-responsive center-block main_page-ad ad">
                    </a>
                </div>
                <div class="col-xs-12 col-md-9 padding-left-0">
                    <video autoplay="" loop="" muted="">
                        <source type="video/mp4" src="{{secure_asset('videos/main_video.mov')}}">
                    </video>
                </div>
            </div>
            <div class="col-xs-12 col-md-3 padding">
                <div class="col-xs-12">
                    <a href="#" class="col-xs-3 icons"><img src="{{secure_asset('images/icons/fb.png')}}" alt=""
                                                            class="img-responsive"></a>
                    <a href="https://www.instagram.com/www_svadba_kz/" class="col-xs-3 icons"><img
                                src="{{secure_asset('images/icons/inst.png')}}" alt="" class="img-responsive"></a>
                    <a href="#" class="col-xs-3 icons"><img src="{{secure_asset('images/icons/vk.png')}}" alt=""
                                                            class="img-responsive"></a>
                    <a href="//www.youtube.com/channel/UCuqcno-2cTI49tl_RqVswTw" class="col-xs-3 icons"><img
                                src="{{secure_asset('images/icons/yout.png')}}" alt="" class="img-responsive"></a>
                </div>
                <div class="col-xs-12 margin-top-always xs-padding-right-left-hidden">
                @if(Auth::check())
                    <div style="border:1px solid black; padding:15px;">
                        <h4>Добро пожаловать - {{Auth::user()->name}}!</h4>
                        @if(Auth::user()->contractors()->first()['ava_path'])
                            <img style="height:200px;" src="{{secure_asset(Auth::user()->contractors()->first()['ava_path'])}}"/>
                        @else
                            <img style="height:200px;" src="{{secure_asset('images/no-avatar.png')}}"/>
                        @endif
                        <h5><a href="{{secure_url('/home')}}">Вход в личный кабинет</a></h5>
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
                                    <h3 class="text-center padding-bottom" style="color: #fff; margin-top: 15px;">Добавьте
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
                                        <a class="btn btn-default btn-lg btn-block" href="{{ secure_url('/password/reset') }}"
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
            <a href="">
                <img src="{{secure_asset('images/main_page-ad.png')}}" alt="" class="img-responsive ad">
            </a>
        </div>
        <div class="col-xs-12 margin-top-always">
            <div class="ui steps center-block text-center">
                <a href="#cities-block" class="link step col-xs-12 col-md-3 xs-padding-right-left-hidden">
                    <div class="content">
                        <img src="{{secure_asset('images/icons/city.png')}}" alt="">
                        <div class="title">Выбрать город</div>
                        <div class="description">Выберите Ваш город проживания</div>
                    </div>
                </a>
                <a href="#cities-block" class="link step col-xs-12 col-md-3 xs-padding-right-left-hidden">
                    <div class="content">
                        <img src="{{secure_asset('images/icons/marry.png')}}" alt="">
                        <div class="title">Собрать пакет</div>
                        <div class="description">Соберите пакет свадебных услуг</div>
                    </div>
                </a>
                <a href="#cities-block" class="link step col-xs-12 col-md-3 xs-padding-right-left-hidden">
                    <div class="content">
                        <img src="{{secure_asset('images/icons/call.png')}}" alt="">
                        <div class="title">Оставить заявку</div>
                        <div class="description">После добавления всех услуг отправьте нам заявку</div>
                    </div>
                </a>
                <div class="link step col-xs-12 col-md-3 xs-padding-right-left-hidden">
                    <div class="content">
                        <img src="{{secure_asset('images/icons/operator.png')}}" alt="">
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
                        <img alt="{{$cit->name_eng.'-flo'}}" src="{{secure_asset('images/icons/'.$cit->name_eng.'-flo.png')}}"
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

