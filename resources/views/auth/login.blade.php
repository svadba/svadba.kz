@extends('layouts.log')

@section('content')
    <div class="ui middle aligned center aligned grid" style="height: 100%;background-color: #DADADA;">
        <div class="column" style="max-width: 450px;">
            <h2 class="ui teal image header">
                <img src="{{secure_asset('images/logo.png')}}" class="image">
                <div class="content">
                    Войдите в свой аккаунт
                </div>
            </h2>
            <form class="ui large form" role="form" method="POST" action="{{ secure_url('/login') }}">
                {{ csrf_field() }}
                <div class="ui stacked raised segments">
                    <div class="ui segment">
                        <div class="field{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="ui left icon input">
                                <i class="at icon"></i>
                                <input id="email" type="email" name="email" placeholder="E-mail"
                                       value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="field{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="ui left icon input">
                                <i class="lock icon"></i>
                                <input type="password" name="password" placeholder="Пароль">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <button class="ui fluid large teal submit button">Войти</button>
                    </div>
                    <div class="ui secondary segment">
                        <p><a href="{{ secure_url('/password/reset') }}">Забыли пароль?</a></p>
                    </div>
                </div>

                <div class="ui error message"></div>

            </form>
            <div class="floating ui message">
                Нет аккаунта? <a href="{{ secure_url('/register') }}">Зарегистрируйся!</a>
            </div>
        </div>
    </div>
@endsection
