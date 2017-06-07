<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0, width=device-width">
    <title>SVADBA.KZ - {{$title or 'no title'}}</title>
    <meta name="description" content="{{$title or 'no title'}} - {{$description or 'no description'}}">
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{secure_asset('images/icons/favicon.ico')}}">
    <link rel="icon" type="image/png" href="{{secure_asset('images/icons/favicon-32x32.png')}}" sizes="32x32">
    <link rel="icon" type="image/png" href="{{secure_asset('images/icons/favicon-16x16.png')}}" sizes="16x16">
    <link rel="stylesheet" href="{{secure_asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/semantic-ui/2.2.10/semantic.min.css">
    <link href="{{secure_asset('css/lightbox.css')}}" rel="stylesheet">
    <link href="{{secure_asset('css/lity.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{secure_asset('css/semanticChange.css')}}">
    <link rel="stylesheet" href="{{secure_asset('css/media.css')}}">
    <link rel="stylesheet" href="{{secure_asset('css/stylesheet.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/0.8.1/cropper.min.css">
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
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function (d, w, c) {
            (w[c] = w[c] || []).push(function () {
                try {
                    w.yaCounter44846083 = new Ya.Metrika({
                        id: 44846083,
                        clickmap: true,
                        trackLinks: true,
                        accurateTrackBounce: true
                    });
                } catch (e) {
                }
            });

            var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () {
                    n.parentNode.insertBefore(s, n);
                };
            s.type = "text/javascript";
            s.async = true;
            s.src = "https://mc.yandex.ru/metrika/watch.js";

            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else {
                f();
            }
        })(document, window, "yandex_metrika_callbacks");
    </script>
</head>
<body class="container-fluid {{$sn or 'ne_peredano'}}">
<nav class="row navbar navbar-default navbar-fixed-top" style="padding: 0;">
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
            <button id="sv_like" class="navbar-brand" style="border:0;outline: 0;"><i class="heart icon"></i><span
                        id="sv_l">{{$svadba_like}}</span>
            </button>
            <a class="navbar-brand" href="{{secure_url('basket/show')}}" style="float: right;">
                <i class="shopping basket icon"></i><span id="count_basket"></span>
            </a>
        </div>
        <div class="collapse navbar-collapse text-center" id="bs-example-navbar-collapse-1"
             style="background: #0abab5; height: 50px !important;">
            <ul class="nav navbar-nav">
                <li>
                    <form method="GET" action="{{secure_asset('/services/filter')}}"
                          class="ui inverted transparent icon input">
                        <input type="text" placeholder="Поиск..." name="search_name">
                        <button class="ui inverted icon button">
                            <i class="search icon"></i>
                        </button>
                    </form>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check())
                    <li><a href="{{secure_url('/logout')}}"><i class="sign out icon"></i>Выйти</a></li>
                @else
                <!--<li style="padding: 7px;">
                        <a class="ui inverted button" href="{{secure_url('login')}}">Вход/Регистрация</a>
                    </li>-->
                    <li><a href="tel:+77770003383"><i class="call icon"></i>+7 (777) 000-3380</a></li>
                @endif
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
        <div class="hidden-xs col-sm-4 ">
            <img src="{{secure_asset('images/logo.png')}}" alt="" class="img-responsive center-block"
                 style="max-width: 150px;">
            <p class="text-center">удобный сервис для подготовки к свадьбе! На нашем
                Республиканском портале Вы
                найдёте все необходимое для вашей свадьбы.</p>
        </div>
        <div class="col-xs-12 col-sm-4 text-center">
            <div class="col-xs-12 margin-bottom-always">
                <a href="//www.facebook.com/Svadbakz-1511652225566976/" target="_blank" class="col-xs-3 icons"><img
                            src="{{secure_asset('images/icons/fb.png')}}" alt=""
                            class="img-responsive"></a>
                <a href="//www.instagram.com/www_svadba_kz/" target="_blank" class="col-xs-3 icons"><img
                            src="{{secure_asset('images/icons/inst.png')}}" alt="" class="img-responsive"></a>
                <a href="//vk.com/svadbakz2017" target="_blank" class="col-xs-3 icons"><img
                            src="{{secure_asset('images/icons/vk.png')}}" alt=""
                            class="img-responsive"></a>
                <a href="//www.youtube.com/channel/UCuqcno-2cTI49tl_RqVswTw" target="_blank" class="col-xs-3 icons"><img
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
            <p class="hidden-xs">Наглядное уведомление потребителей, которые могут не знать о том, что означает символ
                копирайта или же
                заблуждаться относительно объёма авторских прав на данное произведение</p>
        </div>
    </div>
</footer>
<div id="myModal" class="AddToBasket">
    <div class="AddToBasket-content">
        <span class="close">&times;</span>
        <p>Добавлено в корзину</p>
    </div>
</div>
<script type="application/ld+json">
{
  "@context" : "http://schema.org",
  "@type" : "Organization",
  "name" : "Svadba.kz",
  "url" : "https://svadba.kz/",
  "sameAs" : [
    "https://vk.com/svadbakz2017",
    "https://www.facebook.com/Svadbakz-1511652225566976/",
    "https://twitter.com/www_svadba_kz",
    "https://plus.google.com/u/0/116419100382625238337"
  ]
}


































</script>
<noscript>
    <div><img src="https://mc.yandex.ru/watch/44846083" style="position:absolute; left:-9999px;" alt=""/></div>
</noscript>
<!-- /Yandex.Metrika counter -->
<!-- Latest compiled and minified JavaScript -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/semantic-ui/2.2.10/semantic.min.js"></script>
<script src="{{secure_asset('js/lightbox.js')}}"></script>
<script src="{{secure_asset('js/lity.js')}}"></script>
@if(Auth::check())
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/0.8.1/cropper.min.js"></script>
    <script type="text/javascript" src="{{secure_asset('js/home.js')}}"></script>
    <script type="text/javascript" src="{{secure_asset('js/load_images.js')}}"></script>
    <script type="text/javascript" src="{{secure_asset('js/load_musics.js')}}"></script>
@endif
<script type="text/javascript" src="{{secure_asset('js/all_pages.js')}}"></script>
</body>
</html>