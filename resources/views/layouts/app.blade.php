<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Свадебный портал SVADBA.KZ</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/stylesheet.css')}}">
    <link href="{{asset('css/lightbox.css')}}" rel="stylesheet">
    @if(Route::currentRouteName() == 'cities')
        <link rel="stylesheet" type="text/css" href="{{asset('css/cities/'.$nowCity->name_eng.'.css')}}"/>
    @endif
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
            <a class="navbar-brand" href="{{url('/')}}" style="font-weight: bold; font-size: 24px;">svadba.kz</a>
            <a id="sv_like" class="navbar-brand"><i class="heart icon"></i><span id="sv_l">{{$svadba_like}}</span></a>
            <a class="navbar-brand" href="{{url('basket/show')}}" style="float: right;"><i
                        class="shopping basket icon"></i><span id="count_basket"></span></a>
        </div>
        <div class="collapse navbar-collapse text-center" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php $counter = 0; ?>
                @foreach($sort_adverts as $sort)
                    <?php $counter++; ?>
                    @if($counter > 3) @break @endif
                    <li><a href="{{url('/services/filter?category='.$sort->id)}}">{{$sort->name}}
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
                            <li><a href="{{url('/services/filter?category='.$sort->id)}}">{{$sort->name}}
                                    ({{$sort->adverts_count}})</a></li>
                        @endforeach
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
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
            <a href="//svadba.kz" style="font-size: 24px;">svadba.kz</a>
        </div>
        <div class="col-xs-12 col-sm-4">
            <img src="{{asset('images/logo.png')}}" alt="" class="img-responsive center-block"
                 style="max-width: 150px;">
        </div>
        <div class="col-xs-12 col-sm-4 text-center">
            <div class="col-xs-12 margin-bottom-always">
                <a href="#" class="col-xs-3 icons"><img src="{{asset('images/icons/fb.png')}}" alt=""
                                                        class="img-responsive"></a>
                <a href="//www.instagram.com/www_svadba_kz/" class="col-xs-3 icons"><img
                            src="{{asset('images/icons/inst.png')}}" alt="" class="img-responsive"></a>
                <a href="#" class="col-xs-3 icons"><img src="{{asset('images/icons/vk.png')}}" alt=""
                                                        class="img-responsive"></a>
                <a href="//www.youtube.com/channel/UCuqcno-2cTI49tl_RqVswTw" class="col-xs-3 icons"><img
                            src="{{asset('images/icons/yout.png')}}" alt="" class="img-responsive"></a>
            </div>
            <address class="col-xs-12">
                <abbr title="Телефон">Т:</abbr><a href="tel:+77770003383">+7 (777) 000-3383</a><br>
                <abbr title="Телефон">Т:</abbr><a href="tel:+77770003383">+7 (777) 000-3385</a><br><br>
                <strong>г. Астана, ул. Бауржана Момышулы 2/5</strong>
            </address>
        </div>
        <div class="col-xs-12 col-sm-4 text-center">
            <p>&copy; 2017 WWW.SVADBA.KZ</p>
            <p>Наглядное уведомление потребителей, которые могут не знать о том, что означает символ копирайта или же
                заблуждаться относительно объёма авторских прав на данное произведение</p>
        </div>
    </div>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>Добавлено в корзину</p>
        </div>
    </div>
</footer>
<!-- Latest compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/semantic-ui/2.2.10/semantic.min.js"></script>
<script src="{{asset('js/lightbox.js')}}"></script>
<script type="text/javascript" src="{{asset('js/all_pages.js')}}"></script>
</body>
</html>