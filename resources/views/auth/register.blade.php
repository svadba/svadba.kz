@extends('layouts.log')

@section('content')
    <div class="ui middle aligned center aligned grid" style="height: 100%;background-color: #DADADA;">
        <div class="column" style="max-width: 450px;">
            <h2 class="ui teal image header">
                <img src="{{secure_asset('images/logo.png')}}" class="image">
                <div class="content">
                    Регистрация
                </div>
            </h2>
            <form class="ui large form" role="form" method="POST" action="{{ secure_url('/register') }}">
                {{ csrf_field() }}
                <div class="ui stacked raised segments">
                    <div class="ui segment">
                        <div class="field{{ $errors->has('name') ? ' has-error' : '' }}">
                            <div class="ui left icon input">
                                <i class="user icon"></i>
                                <input id="name" type="text" name="name" value="{{ old('name') }}"
                                       placeholder="Введите свое имя">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="field{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="ui left icon input">
                                <i class="at icon"></i>
                                <input id="email" type="email" name="email" value="{{ old('email') }}"
                                       placeholder="Введите свой email">
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
                                <input id="password" type="password" name="password" placeholder="Пароль">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="field{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <div class="ui left icon input">
                                <i class="lock icon"></i>
                                <input id="password-confirm" type="password" name="password_confirmation"
                                       placeholder="Подтвердите пароль">
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <button class="ui fluid large teal submit button">Зарегистрироваться</button>
                    </div>
                </div>

                <div class="ui error message"></div>

            </form>
        </div>
    </div>
@endsection
