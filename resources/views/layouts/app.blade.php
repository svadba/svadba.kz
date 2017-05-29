<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0, width=device-width">
    <title>SVADBA.KZ - {{$title or 'no title'}}</title>
    <meta name="description" content="{{$title or 'no title'}} - {{$description or 'no description'}}">
    <meta name="csrf-token" id="csrf-token" content="{{{ csrf_token() }}}">
    <link rel="stylesheet" href="{{secure_asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/semantic-ui/2.2.10/semantic.min.css">
    <link href="{{secure_asset('css/lightbox.css')}}" rel="stylesheet">
    <link href="{{secure_asset('css/lity.css')}}" rel="stylesheet">
    <link href="{{secure_asset('css/very_inputs.css')}}" rel="stylesheet">
    <link href="{{secure_asset('css/load_musics.css')}}" rel="stylesheet">
    @if(Route::currentRouteName() == 'cities')
        <link rel="stylesheet" type="text/css" href="{{secure_asset('css/cities/'.$nowCity->name_eng.'.css')}}"/>
    @endif
    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
        ga('create', 'UA-99325113-1', 'auto');
        ga('require', 'GTM-KL395WG');
        ga('send', 'pageview');
    </script>
    <style>
        .async-hide {
            opacity: 0 !important
        }
    </style>
    <script>
        (function (a, s, y, n, c, h, i, d, e) {
            s.className += ' ' + y;
            h.start = 1 * new Date;
            h.end = i = function () {
                s.className = s.className.replace(RegExp(' ?' + y), '')
            };
            (a[n] = a[n] || []).hide = h;
            setTimeout(function () {
                i();
                h.end = null
            }, c);
            h.timeout = c;
        })(window, document.documentElement, 'async-hide', 'dataLayer', 4000,
            {'GTM-KL395WG': true});
    </script>
    <link rel="stylesheet" href="{{secure_asset('css/stylesheet.css')}}">
</head>
<body class="container-fluid {{$sn or 'ne_peredano'}}">
<nav class="row navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{secure_url('/')}}" style="font-weight: bold; font-size: 24px;">svadba.kz</a>
            <a id="sv_like" class="navbar-brand"><i class="heart icon"></i><span id="sv_l">{{$svadba_like}}</span></a>
            <a class="navbar-brand" href="{{secure_url('basket/show')}}" style="float: right;"><i
                        class="shopping basket icon"></i><span id="count_basket"></span></a>
        </div>
        <div class="collapse navbar-collapse text-center" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php $counter = 0; ?>
                @foreach($sort_adverts as $sort)
                    <?php $counter++; ?>
                    @if($counter > 3) @break @endif
                    <li><a href="{{secure_url('/services/filter?category='.$sort->id)}}">{{$sort->name}}
                            ({{$sort->adverts_count}})</a></li>
                @endforeach
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Все услуги <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php $counter2 = 0; ?>
                        @foreach($sort_adverts as $sort)
                            <?php $counter2++; ?>
                            @if($counter2 < 4) @continue @endif
                            <li><a href="{{secure_url('/services/filter?category='.$sort->id)}}">{{$sort->name}}
                                    ({{$sort->adverts_count}})</a></li>
                        @endforeach
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check())
                    <li><a href="{{secure_url('/logout')}}"><i class="call icon"></i>Выйти</a></li>
                @endif
                <li><a href="tel:+77770003383"><i class="call icon"></i>+7 (777) 000-3380</a></li>
            </ul>
        </div>
    </div>
</nav>
@yield('content')
<footer class="row">
    <div class="center-block col-xs-12" style="max-width: 1440px; float: none;">
        <div class="col-xs-12 text-center margin-bottom-always">
            <p class="margin-top-always" style="font-size: 18px; margin-bottom: 0;">Идеально - не значит дорого!</p>
            <a href="{{secure_url('/')}}" style="font-size: 24px;">svadba.kz</a>
        </div>
        <div class="col-xs-12 col-sm-4">
            <img src="{{secure_asset('images/logo.png')}}" alt="" class="img-responsive center-block"
                 style="max-width: 150px;">
        </div>
        <div class="col-xs-12 col-sm-4 text-center">
            <div class="col-xs-12 margin-bottom-always">
                <a href="#" class="col-xs-3 icons"><img src="{{secure_asset('images/icons/fb.png')}}" alt=""
                                                        class="img-responsive"></a>
                <a href="https://www.instagram.com/www_svadba_kz/" class="col-xs-3 icons"><img
                            src="{{secure_asset('images/icons/inst.png')}}" alt="" class="img-responsive"></a>
                <a href="#" class="col-xs-3 icons"><img src="{{secure_asset('images/icons/vk.png')}}" alt=""
                                                        class="img-responsive"></a>
                <a href="//www.youtube.com/channel/UCuqcno-2cTI49tl_RqVswTw" class="col-xs-3 icons"><img
                            src="{{secure_asset('images/icons/yout.png')}}" alt="" class="img-responsive"></a>
            </div>
            <address class="col-xs-12">
                <abbr title="Телефон">Т:</abbr><a href="tel:+77770003383">+7 (777) 000-3383</a><br>
                <abbr title="Телефон">Т:</abbr><a href="tel:+77770003385">+7 (777) 000-3385</a><br><br>
                <strong>г. Астана, ул. Бауржана Момышулы 2/5</strong>
            </address>
        </div>
        <div class="col-xs-12 col-sm-4 text-center">
            <p>&copy; 2017 WWW.SVADBA.KZ</p>
            <p>Наглядное уведомление потребителей, которые могут не знать о том, что означает символ копирайта или же
                заблуждаться относительно объёма авторских прав на данное произведение</p>
        </div>
    </div>
    <div id="myModal" class="AddToBasket">
        <div class="AddToBasket-content">
            <span class="close">&times;</span>
            <p>Добавлено в корзину</p>
        </div>
    </div>
</footer>
<!-- Latest compiled and minified JavaScript -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/semantic-ui/2.2.10/semantic.min.js"></script>
<script src="{{secure_asset('js/lightbox.js')}}"></script>
<script src="{{secure_asset('js/lity.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript" src="{{secure_asset('js/all_pages.js')}}"></script>
@if(Auth::check())
    <script type="text/javascript" src="{{secure_asset('js/home.js')}}"></script>
    <script type="text/javascript" src="{{secure_asset('js/load_images.js')}}"></script>
    <script type="text/javascript" src="{{secure_asset('js/load_musics.js')}}"></script>
@endif
</body>
</html>