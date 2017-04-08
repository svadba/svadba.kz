<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SVADBA.KZ</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
    <link rel="stylesheet" href={{asset('css/main.css')}}/>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body>
	<div class="body container">
		<header class="row">
			@if (Auth::guest())
                        <div class="header_login_wrap col-xs-12 col-sm-12 col-md-4">
						<a href="articles.html" class="big_reg_button_new btn btn-default" role="button">Все статьи</a>
						<a href="services.html" class="big_reg_button_new btn btn-default" role="button">Все специалисты</a>
					</div>
					<div class="header_logo col-xs-12 col-sm-12 col-md-4"><img src="assets/img/logo.jpg" class="img-responsive center-block">
					</div>
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
								<li class="first"><a href="tag/wedding_plan.html">Планирование свадьбы</a>
								</li>
								<li class="have_sub" id="s1"><a href="https://marry.ua/#">Рекомендуемые специалисты</a><span class="caret"></span>
									<div class="sub_top_menu trends">
										<div style="float: left; width: 140px">
											<a href="articles/decorating/filter.html" class="block non_bottom">
												<div class="rose"></div><img src="assets/img/sub_menu/Menu_n_1.png" nopin="nopin"><span class="lt">Оформление свадьбы</span>
											</a>
											<a href="articles/accessories/filter.html" class="block">
												<div class="rose"></div><img src="assets/img/sub_menu/Menu_n_5.png" nopin="nopin"><span class="lt">Аксессуары и украшения</span>
											</a>
										</div>
										<div style="float: left; width: 211px">
											<a href="articles/video/filter.html" class="block non_bottom">
												<div class="rose"></div><img src="assets/img/sub_menu/Menu_n_2.png" nopin="nopin"><span class="lt">Свадебная<br>
												видеосъемка,<br>
												видео для свадьбы</span>
											</a>
										</div>
										<div style="float: left; width: 140px">
											<a href="articles/toaster/filter.html" class="block non_bottom">
												<div class="rose"></div><img src="assets/img/sub_menu/Menu_n_3.png" nopin="nopin"><span class="lt">Тамада<br> и ведущие</span>
											</a>
											<a href="articles/photo/filter.html" class="block">
												<div class="rose"></div><img src="assets/img/sub_menu/Menu_n_4.png" nopin="nopin"><span class="lt">Свадебный фотограф</span>
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
					$(function(){
						$('li[id ^= s1]').hover(function(){
							$('.trends').toggleClass('show')
						});
						$('li[id ^= s2]').hover(function(){
							$('.real').toggleClass('show')
						});
					});
				</script>

				<li class="first"><a href="tag/wedding_plan.html">Планирование свадьбы</a>
				</li>
				<li class="have_sub" id="s1"><a href="https://marry.ua/#">Рекомендуемые специалисты</a><span class="caret"></span>
					<div class="sub_top_menu trends">
						<div style="float: left; width: 140px">
							<a href="articles/decorating/filter.html" class="block non_bottom">
								<div class="rose"></div><img src="assets/img/sub_menu/Menu_n_1.png" nopin="nopin"><span class="lt">Оформление свадьбы</span>
							</a>
							<a href="articles/accessories/filter.html" class="block">
								<div class="rose"></div><img src="assets/img/sub_menu/Menu_n_5.png" nopin="nopin"><span class="lt">Аксессуары и украшения</span>
							</a>
						</div>
						<div style="float: left; width: 211px">
							<a href="articles/video/filter.html" class="block non_bottom">
								<div class="rose"></div><img src="assets/img/sub_menu/Menu_n_2.png" nopin="nopin"><span class="lt">Свадебная<br>
								видеосъемка,<br>
								видео для свадьбы</span>
							</a>
						</div>
						<div style="float: left; width: 140px">
							<a href="articles/toaster/filter.html" class="block non_bottom">
								<div class="rose"></div><img src="assets/img/sub_menu/Menu_n_3.png" nopin="nopin"><span class="lt">Тамада<br> и ведущие</span>
							</a>
							<a href="articles/photo/filter.html" class="block">
								<div class="rose"></div><img src="assets/img/sub_menu/Menu_n_4.png" nopin="nopin"><span class="lt">Свадебный фотограф</span>
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
		</header>
		@yield('content')
		<footer>
			<div class="col-xs-12">
				<div class="col-xs-3">
					<h5 class="text-center"><a href="">Помощь и правила</a></h3>
					</div>
					<div class="col-xs-3">
						<h5 class="text-center"><a href="">Реклама</a></h3>
						</div>
						<div class="col-xs-3">
							<h5 class="text-center"><a href="">О нас</a></h3>
							</div>
							<div class="col-xs-3">
								<h5 class="text-center"><a href="">Контакты</a></h3>
								</div>
							</div>
							<div class="col-xs-12">
								<div class="col-xs-2">
									<img src="assets/img/logo.jpg" class="img-responsive center-block" alt="Responsive image">
								</div>
								<div class="col-xs-10">
									© 2014–2017	Портал The-wedding.ru о современных и стильных свадьбах в Москве, РФ и СНГ. Новый способ планирования свадьбы: советы, идеи и вдохновение, фотоидеи, свадьбы, обсуждения, события и каталог компаний твоего города.

									Использование материалов The-wedding.ru разрешено только с предварительного согласия правообладателей. Все права на картинки и тексты принадлежат их авторам. Сайт может содержать контент, не предназначенный для лиц младше 16-ти лет.
								</div>
							</div>
						</footer>
					</div>
					<script>
						$(function(){
							$('a[id ^= sya]').click(function(){
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