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
@yield('content')
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
    <script type="text/javascript" src="{{secure_asset('js/home.js')}}"></script>
    <script type="text/javascript" src="{{secure_asset('js/load_images.js')}}"></script>
    <script type="text/javascript" src="{{secure_asset('js/load_musics.js')}}"></script>
@endif
<script type="text/javascript" src="{{secure_asset('js/all_pages.js')}}"></script>
</body>
</html>