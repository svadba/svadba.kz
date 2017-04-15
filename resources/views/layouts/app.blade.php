<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Свадебный портал SVADBA.KZ</title>
        <link rel="shortcut icon" href="{{asset('assets/img/logo.png')}}" type="image/png">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/new/style.css')}}" />
        @if(Route::currentRouteName() == 'cities')
            <link rel="stylesheet" type="text/css" href="{{asset('css/cities/'.$nowCity->name_eng.'.css')}}" />
        @endif
        <!-- Latest compiled and minified JavaScript -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script type="text/javascript">
            $(function () {
                $('li[id ^= s1]').hover(function () {
                    $('.trends').toggleClass('show')
                });
                $('li[id ^= s2]').hover(function () {
                    $('.real').toggleClass('show')
                });
            });
            $(document).ready(function () {
                $(window).scroll(function () {
                    if ($(this).scrollTop() > 100) {
                        $('.scrollup').fadeIn();
                    } else {
                        $('.scrollup').fadeOut();
                    }
                });

                $('.scrollup').click(function () {
                    $("html, body").animate({scrollTop: 0}, 600);
                    return false;
                });

            });
	    </script>
        <script type="text/javascript">
            $(document).ready(function(){
                $(window).scroll(function(){
                    if ($(this).scrollTop() > 100) {
                        $('.scrollup').fadeIn();
                    } else {
                        $('.scrollup').fadeOut();
                    }
                });
                $('.scrollup').click(function(){
                    $("html, body").animate({ scrollTop: 0 }, 600);
                    return false;
                });
            });
            $( function() {
                $( "#slider-range" ).slider({
                    range: true,
                    min: 1,
                    max: 10000000,
                    values: [ 75, 5000000 ],
                    slide: function( event, ui ) {
                        $( "#amount" ).val( "" + ui.values[ 0 ] + " - " + ui.values[ 1 ] + "т" );
                    }
                });
                $( "#amount" ).val( "" + $( "#slider-range" ).slider( "values", 0 ) +
                    " - " + $( "#slider-range" ).slider( "values", 1 ) + "т" );
            });
        </script>
<body class="{{$sn or 'ne_peredano'}} center-block">
	<div class="container-fluid">
		<header class="row">
                        <div class="header_login_wrap col-xs-12 col-sm-12 col-md-4">
						<a href="" class="btn header-btn-wbg" role="button">Все статьи</a>
						<a href="{{url('/services/')}}" class="btn header-btn" role="button">Все услуги</a>
					</div>
					<div class="header_logo col-xs-12 col-sm-12 col-md-4"><a href="{{url('/')}}"><img src="{{asset('assets/img/logo.png')}}" class="img-responsive center-block"></a>
    </div>@if (Auth::guest())
    <div class="header_login_wrap col-xs-12 col-sm-12 col-md-4">
        <a class="btn header-btn" role="button" href="{{url('/login')}}" rel="nofollow" title="Войти">Вход</a>
        <a class="btn header-btn-wbg" role="button" href="{{url('/register')}}" rel="nofollow" title="Регистрация специалистов"s">Регистрация</a>
    </div>
    @else
    <li style="float:right;" class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            {{ Auth::user()->name }} <span class="caret"></span>
        </a>

        <ul class="dropdown-menu" role="menu">
            @foreach(Auth::user()->roles as $role)
            <li><a href="{{ url('/admin/'.$role->name_eng) }}"><i class="fa fa-btn"></i>{{$role->name}}</a></li>
            @endforeach
            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
        </ul>
    </li>
    @endif
    <div class="under_wrap col-xs-12">
        <img src="{{asset('assets/img/header_under.png')}}" class="img-responsive" alt="Responsive image">
    </div>
    <div class="outer-menu hidden-sm hidden-md hidden-lg">
        <input class="checkbox-toggle" type="checkbox" />
        <div class="hamburger">
            <div></div>
        </div>
        <div class="menu">
            <div>
                <div>
                    <ul id="top_menu" class="collapse col-xs-12">
                        <li class="first"><a href="{{url('/weddingPlan')}}">Планирование свадьбы</a>
                        </li>
                        <li class="have_sub" id="s1"><a href="">Рекомендуемые услуги</a><span class="caret"></span>
                            <div class="sub_top_menu trends">
                                <div style="float: left; width: 140px">
                                    <a href="{{url('')}}" class="block non_bottom">
                                        <div class="rose"></div><img src="{{asset('assets/img/sub_menu/Menu_n_1.png')}}" nopin="nopin"><span class="lt">Оформление свадьбы</span>
                                    </a>
                                    <a href="{{url('')}}" class="block">
                                        <div class="rose"></div><img src="{{asset('assets/img/sub_menu/Menu_n_5.png')}}" nopin="nopin"><span class="lt">Салоны красоты/span>
                                    </a>
                                </div>
                                <div style="float: left; width: 211px">
                                    <a href="{{url('')}}" class="block non_bottom">
                                        <div class="rose"></div><img src="{{asset('assets/img/sub_menu/Menu_n_2.png')}}" nopin="nopin"><span class="lt">Свадебная<br>
                                            видеосъемка,<br>
                                            видео для свадьбы</span>
                                    </a>
                                </div>
                                <div style="float: left; width: 140px">
                                    <a href="{{url('')}}" class="block non_bottom">
                                        <div class="rose"></div><img src="{{asset('assets/img/sub_menu/Menu_n_3.png')}}" nopin="nopin"><span class="lt">Тамада<br> и ведущие</span>
                                    </a>
                                    <a href="{{url('')}}" class="block">
                                        <div class="rose"></div><img src="{{asset('assets/img/sub_menu/Menu_n_4.png')}}" nopin="nopin"><span class="lt">Свадебный фотограф</span>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class=""><a href="">Мастер-классы</a>
                        </li>
                        <li class="have_sub" id="s2"><a href="">Реальные истории</a><span class="caret"></span>
                            <div class="sub_top_menu real">
                                <div style="float: left; width: 125px">
                                    <a href="" class="block">
                                        <div class="rose"></div><img src="assets/img/sub_menu/menu_10.jpg" nopin="nopin"><span class="lt">Стилизованные<br> съемки</span>
                                    </a>
                                </div>
                                <div style="float: left; width: 280px">
                                    <a href="" class="block non_bottom">
                                        <div class="rose"></div><img src="assets/img/sub_menu/menu3.png" nopin="nopin"><span class="rt">Lovestory</span>
                                    </a>
                                    <a href="" class="block">
                                        <div class="rose"></div><img src="assets/img/sub_menu/menu8.png" nopin="nopin"><span class="rb">Послесвадебная съемка</span>
                                    </a>
                                </div>
                                <div style="float: left; width: 140px">
                                    <a href="" class="block">
                                        <div class="rose"></div><img src="assets/img/sub_menu/menu4.png" nopin="nopin"><span class="lt">Свадьбы</span>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="last">
                            <form action="" id="search_form" class="top_search_wrap">
                                <input type="text" name="term" placeholder="Поиск по сайту" id="top_search">
                                <div class="search_submit" onclick="$('#search_form').submit();"></div>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <ul id="top_menu" class="collapse col-xs-12">
        <li class="first"><a href="{{url('/weddingPlan')}}">Планирование свадьбы</a>
        </li>
        <li class="have_sub" id="s1"><a href="">Рекомендуемые услуги</a><span class="caret"></span>
            <div class="sub_top_menu trends">
                <div style="float: left; width: 140px">
                    <a href="{{url('')}}" class="block non_bottom">
                        <div class="rose"></div><img src="{{asset('assets/img/sub_menu/Menu_n_1.png')}}" nopin="nopin"><span class="lt">Оформление свадьбы</span>
							</a>
							<a href="{{url('')}}" class="block">
                        <div class="rose"></div><img src="{{asset('assets/img/sub_menu/Menu_n_5.png')}}" nopin="nopin"><span class="lt">Аксессуары и украшения</span>
                    </a>
                </div>
                <div style="float: left; width: 211px">
                    <a href="{{url('')}}" class="block non_bottom">
                        <div class="rose"></div><img src="{{asset('assets/img/sub_menu/Menu_n_2.png')}}" nopin="nopin"><span class="lt">Свадебная<br>
                            видеосъемка,<br>
                            видео для свадьбы</span>
                    </a>
                </div>
                <div style="float: left; width: 140px">
                    <a href="{{url('')}}" class="block non_bottom">
                        <div class="rose"></div><img src="{{asset('assets/img/sub_menu/Menu_n_3.png')}}" nopin="nopin"><span class="lt">Тамада<br> и ведущие</span>
                    </a>
                    <a href="{{url('')}}" class="block">
                        <div class="rose"></div><img src="{{asset('assets/img/sub_menu/Menu_n_4.png')}}" nopin="nopin"><span class="lt">Свадебный фотограф</span>
                    </a>
                </div>
            </div>
        </li>
        <li class=""><a href="">Мастер-классы</a>
        </li>
        <li class="have_sub" id="s2"><a href="">Реальные истории</a><span class="caret"></span>
            <div class="sub_top_menu real">
                <div style="float: left; width: 125px">
                    <a href="" class="block">
                        <div class="rose"></div><img src="{{asset('assets/img/sub_menu/menu_10.jpg')}}" nopin="nopin"><span class="lt">Стилизованные<br> съемки</span>
                    </a>
                </div>
                <div style="float: left; width: 280px">
                    <a href="" class="block non_bottom">
                        <div class="rose"></div><img src="{{asset('assets/img/sub_menu/menu3.png')}}" nopin="nopin"><span class="rt">Lovestory</span>
                    </a>
                    <a href="" class="block">
                        <div class="rose"></div><img src="{{asset('assets/img/sub_menu/menu8.png')}}" nopin="nopin"><span class="rb">Послесвадебная съемка</span>
                    </a>
                </div>
                <div style="float: left; width: 140px">
                    <a href="" class="block">
                        <div class="rose"></div><img src="{{asset('assets/img/sub_menu/menu4.png')}}" nopin="nopin"><span class="lt">Свадьбы</span>
                    </a>
                </div>
            </div>
        </li>
        <li class="last">
            <form action="" id="search_form" class="top_search_wrap">
                <input type="text" name="term" placeholder="Поиск по сайту" id="top_search">
                <div class="search_submit" onclick="$('#search_form').submit();"></div>
            </form>
        </li>
    </ul>
</header>
@yield('content')
<footer>
    <div class="col-xs-12">
        <div class="col-xs-3">
            <h5 class="text-center"><a href="{{url('/rules_and_help')}}">Помощь и правила</a></h5>
        </div>
        <div class="col-xs-3">
            <h5 class="text-center"><a href="{{url('/advertising')}}">Реклама</a></h5>
        </div>
        <div class="col-xs-3">
            <h5 class="text-center"><a href="{{url('/about')}}">О нас</a></h5>
        </div>
        <div class="col-xs-3">
            <h5 class="text-center"><a href="{{url('/contacts')}}">Контакты</a></h5>
	    </div>
	</div>
							<div class="col-xs-12">
								<div class="col-xs-12 col-sm-2">
                <img src="{{asset('assets/img/logo.jpg')}}" class="img-responsive center-block" alt="Responsive image">
                </div>
                <div class="col-xs-12 col-sm-10">
                    © 2017	Портал SVADBA.KZ о современных и стильных свадьбах в Казахстане и СНГ. Новый способ планирования свадьбы: советы, идеи и вдохновение, фотоидеи, свадьбы, обсуждения, события и каталог компаний твоего города.

                    Использование материалов SVADBA.KZ разрешено только с предварительного согласия правообладателей. Все права на картинки и тексты принадлежат их авторам.
                </div>
        </div>
</footer>
</div>
<script>
    $(function () {
        $('a[id ^= sya]').click(function () {
            $('.sya_form').toggleClass('show');
            $('.sya').toggleClass('sya_active');
            $('.scrollup').toggleClass('scrollup_active')
        });
    });
</script>
<div class="sya_form">
    <div class="form-group">
        <label for="InputEmail">Email адрес</label>
        <input type="email" class="form-control" id="InputEmail" placeholder="email">
    </div>
    <div class="form-group">
        <label for="InputPhone">Телефон</label>
        <input type="phone" class="form-control" id="InputPhone" placeholder="телефон">
    </div>
    <button type="submit" class="btn btn-default" onclick="alertify.success("Success notification");">Отправить</button>
					</div>
					<a class="sya" id="sya">Оставить заявку</a>
					<a href="#" class="scrollup">&#8593;</a>
{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>