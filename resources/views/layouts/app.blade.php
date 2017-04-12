<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Свадебный портал SVADBA.KZ</title>
        <link rel="stylesheet" href="{{asset('assets/bootstrap-3.3.6/css/bootstrap.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/allinone.min.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/new/style.css')}}" />
        @if(Route::currentRouteName() == 'cities')
            <link rel="stylesheet" type="text/css" href="{{asset('css/cities/'.$nowCity->name_eng.'.css')}}" />
        @endif

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script type="text/javascript">
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
                    min: 0,
                    max: 500,
                    values: [ 75, 300 ],
                    slide: function( event, ui ) {
                        $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
                    }
                });
                $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
                    " - $" + $( "#slider-range" ).slider( "values", 1 ) );
            } );
            $(function(){
                $('li[id ^= s1]').hover(function(){
                    $('.trends').toggleClass('show')
                });
                $('li[id ^= s2]').hover(function(){
                    $('.real').toggleClass('show')
                });
            });
        </script>
<body class="{{$sn or 'ne_peredano'}}">
	<div class="body container">
		<header class="row">
			
                        <div class="header_login_wrap col-xs-12 col-sm-12 col-md-4">
						<a href="" class="big_reg_button_new btn btn-default" role="button">Все статьи</a>
						<a href="{{url('/services/')}}" class="big_reg_button_new btn btn-default" role="button">Все услуги</a>
					</div>
					<div class="header_logo col-xs-12 col-sm-12 col-md-4"><a href="{{url('/')}}"><img src="{{asset('assets/img/logo.jpg')}}" class="img-responsive center-block"></a>
    </div>@if (Auth::guest())
    <div class="header_login_wrap col-xs-12 col-sm-12 col-md-4">
        <a class="header_login_button_new btn btn-default" role="button" href="{{url('/login')}}" rel="nofollow" title="Войти">Вход</a>
        <a class="big_reg_button_new btn btn-default" role="button" href="{{url('/registration')}}" rel="nofollow" title="Регистрация специалистов"s">Регистрация</a>
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
        <div class="under_text"></div>
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
                        <li class="have_sub" id="s1"><a href="https://marry.ua/#">Рекомендуемые услуги</a><span class="caret"></span>
                            <div class="sub_top_menu trends">
                                <div style="float: left; width: 140px">
                                    <a href="{{url('/specialists/decorators')}}" class="block non_bottom">
                                        <div class="rose"></div><img src="{{asset('assets/img/sub_menu/Menu_n_1.png')}}" nopin="nopin"><span class="lt">Оформление свадьбы</span>
                                    </a>
                                    <a href="{{url('/specialists/wedding_salons')}}" class="block">
                                        <div class="rose"></div><img src="{{asset('assets/img/sub_menu/Menu_n_5.png')}}" nopin="nopin"><span class="lt">Салоны красоты/span>
                                    </a>
                                </div>
                                <div style="float: left; width: 211px">
                                    <a href="{{url('specialists/videographers')}}" class="block non_bottom">
                                        <div class="rose"></div><img src="{{asset('assets/img/sub_menu/Menu_n_2.png')}}" nopin="nopin"><span class="lt">Свадебная<br>
                                            видеосъемка,<br>
                                            видео для свадьбы</span>
                                    </a>
                                </div>
                                <div style="float: left; width: 140px">
                                    <a href="{{url('specialists/leading')}}" class="block non_bottom">
                                        <div class="rose"></div><img src="{{asset('assets/img/sub_menu/Menu_n_3.png')}}" nopin="nopin"><span class="lt">Тамада<br> и ведущие</span>
                                    </a>
                                    <a href="{{url('specialists/photographers')}}" class="block">
                                        <div class="rose"></div><img src="{{asset('assets/img/sub_menu/Menu_n_4.png')}}" nopin="nopin"><span class="lt">Свадебный фотограф</span>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class=""><a href="articles/wedding_diy.html">Мастер-классы</a>
                        </li>
                        <li class="have_sub" id="s2"><a href="blog//real_stories.html">Реальные истории</a><span class="caret"></span>
                            <div class="sub_top_menu real">
                                <div style="float: left; width: 125px">
                                    <a href="tag/other_shootings.html" class="block">
                                        <div class="rose"></div><img src="assets/img/sub_menu/menu_10.jpg" nopin="nopin"><span class="lt">Стилизованные<br> съемки</span>
                                    </a>
                                </div>
                                <div style="float: left; width: 280px">
                                    <a href="tag/lovestory.html" class="block non_bottom">
                                        <div class="rose"></div><img src="assets/img/sub_menu/menu3.png" nopin="nopin"><span class="rt">Lovestory</span>
                                    </a>
                                    <a href="tag/after_wedding_photo.html" class="block">
                                        <div class="rose"></div><img src="assets/img/sub_menu/menu8.png" nopin="nopin"><span class="rb">Послесвадебная съемка</span>
                                    </a>
                                </div>
                                <div style="float: left; width: 140px">
                                    <a href="tag/weddings.html" class="block">
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
        <script>
            $(function () {
                $('li[id ^= s1]').hover(function () {
                    $('.trends').toggleClass('show')
                });
                $('li[id ^= s2]').hover(function () {
                    $('.real').toggleClass('show')
                });
            });
        </script>

        <li class="first"><a href="{{url('/weddingPlan')}}">Планирование свадьбы</a>
        </li>
        <li class="have_sub" id="s1"><a href="https://marry.ua/#">Рекомендуемые услуги</a><span class="caret"></span>
            <div class="sub_top_menu trends">
                <div style="float: left; width: 140px">
                    <a href="{{url('/specialists/decorators')}}" class="block non_bottom">
                        <div class="rose"></div><img src="{{asset('assets/img/sub_menu/Menu_n_1.png')}}" nopin="nopin"><span class="lt">Оформление свадьбы</span>
							</a>
							<a href="{{url('/specialists/wedding_salons')}}" class="block">
                        <div class="rose"></div><img src="{{asset('assets/img/sub_menu/Menu_n_5.png')}}" nopin="nopin"><span class="lt">Аксессуары и украшения</span>
                    </a>
                </div>
                <div style="float: left; width: 211px">
                    <a href="{{url('/specialists/videographers')}}" class="block non_bottom">
                        <div class="rose"></div><img src="{{asset('assets/img/sub_menu/Menu_n_2.png')}}" nopin="nopin"><span class="lt">Свадебная<br>
                            видеосъемка,<br>
                            видео для свадьбы</span>
                    </a>
                </div>
                <div style="float: left; width: 140px">
                    <a href="{{url('/specialists/leading')}}" class="block non_bottom">
                        <div class="rose"></div><img src="{{asset('assets/img/sub_menu/Menu_n_3.png')}}" nopin="nopin"><span class="lt">Тамада<br> и ведущие</span>
                    </a>
                    <a href="{{url('/specialists/photographers')}}" class="block">
                        <div class="rose"></div><img src="{{asset('assets/img/sub_menu/Menu_n_4.png')}}" nopin="nopin"><span class="lt">Свадебный фотограф</span>
                    </a>
                </div>
            </div>
        </li>
        <li class=""><a href="articles/wedding_diy.html">Мастер-классы</a>
        </li>
        <li class="have_sub" id="s2"><a href="articles/real_stories.html">Реальные истории</a><span class="caret"></span>
            <div class="sub_top_menu real">
                <div style="float: left; width: 125px">
                    <a href="tag/other_shootings.html" class="block">
                        <div class="rose"></div><img src="{{asset('assets/img/sub_menu/menu_10.jpg')}}" nopin="nopin"><span class="lt">Стилизованные<br> съемки</span>
                    </a>
                </div>
                <div style="float: left; width: 280px">
                    <a href="tag/lovestory.html" class="block non_bottom">
                        <div class="rose"></div><img src="{{asset('assets/img/sub_menu/menu3.png')}}" nopin="nopin"><span class="rt">Lovestory</span>
                    </a>
                    <a href="tag/after_wedding_photo.html" class="block">
                        <div class="rose"></div><img src="{{asset('assets/img/sub_menu/menu8.png')}}" nopin="nopin"><span class="rb">Послесвадебная съемка</span>
                    </a>
                </div>
                <div style="float: left; width: 140px">
                    <a href="tag/weddings.html" class="block">
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
        <input type="email" class="form-control" id="InputEmail" placeholder="Email">
    </div>
    <div class="form-group">
        <label for="InputPhone">Телефон</label>
        <input type="phone" class="form-control" id="InputPhone" placeholder="Телефон">
    </div>
    <button type="submit" class="btn btn-default" onclick="alertify.success("Success notification");">Отправить</button>
					</div>
					<a class="sya" id="sya">Оставить заявку</a>
					<a href="#" class="scrollup">&#8593;</a>
{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>