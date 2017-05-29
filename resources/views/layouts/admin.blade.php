<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" id="csrf-token" content="{{{ csrf_token() }}}">
    <title>Панель администратора</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
    

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{secure_asset('admin_wp/css/main.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{secure_asset('admin_wp/css/fe.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{secure_asset('admin_wp/css/media.css')}}" type="text/css"/>
    <link href="{{secure_asset('admin_wp/css/datepicker.min.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/semantic-ui/2.2.10/semantic.min.css"  type="text/css"/>
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src='https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=fu9l7zaptpht8nnj0a458vczysovxgd2s4r012el9us4paot'></script>
    <script src="https://cdn.jsdelivr.net/semantic-ui/2.2.10/semantic.min.js"></script>
    <script src="{{secure_asset('admin_wp/js/datepicker.min.js')}}"></script>
    <script>
        tinymce.init({
            selector: '#descri_text',
            theme: 'modern',
            height: 300,
            language_secure_url: '/js/rutini.js',
            plugins: [
            'advlist autolink lists charmap print preview hr anchor pagebreak spellchecker',
            'searchreplace wordcount visualblocks visualchars fullscreen insertdatetime nonbreaking',
            'save table contextmenu directionality emoticons template paste textcolor'
            ],
            content_css: 'css/content.css',
            toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | forecolor '
        });
    </script>
    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ secure_url('/home') }}">
                    Админка
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    @if(ServiceMan::canView(3))
                    <li><a href="{{ secure_url('admin/contractors/my') }}">Подрядчики - {{$count_cont}}</a></li>
                    @endif
                    @if(ServiceMan::canView(3))
                    <li><a href="{{ secure_url('admin/adverts/my') }}">Объявления - {{$count_adv}}</a></li>
                    @endif
                    @if(ServiceMan::canView(2))
                    <li><a href="{{ secure_url('admin/posts/my') }}">Статьи</a></li>
                    @endif
                    @if(ServiceMan::canView(4))
                    @if($count_basket)
                    <li><a style="color:red;" href="{{ secure_url('admin/requests/baskets') }}">Заявки - {{$count_basket}}</a></li>
                    @else
                    <li><a href="{{ secure_url('admin/requests/baskets') }}">Заявки</a></li>
                    @endif
                    @endif
                    @if(ServiceMan::canView())
                    <li><a href="{{ secure_url('admin/combos/all') }}">Пакеты</a></li>
                    @endif
                    @if(ServiceMan::canView())
                    <li><a href="{{ secure_url('admin/list_data/cities') }}">Списки данных</a></li>
                    @endif
                    @if(ServiceMan::canView())
                    <li><a href="{{ secure_url('admin/site_users') }}">Пользователи</a></li>
                    @endif
                </ul>
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                    <li><a href="{{ secure_url('/login') }}">Login</a></li>
                    <li><a href="{{ secure_url('/register') }}">Register</a></li>
                    @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            @foreach(Auth::user()->roles as $role)
                            <li><a href="{{ secure_url('/admin/'.$role->name_eng) }}"><i class="fa fa-btn"></i>{{$role->name}}</a></li>
                            @endforeach
                            <li><a href="{{ secure_url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                        </ul>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
