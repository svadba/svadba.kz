@extends('layouts.app')

@section('content')
    <div class="body row text-center">
        <div class="ui tablet stackable steps">
            <a href="{{secure_url('/home/adverts/edit/'.$advert->id.'/step1')}}" class="active step">
                <i class="edit icon"></i>
                <div class="content">
                    <div class="title">Описание</div>
                    <div class="description">Введите основную информацию</div>
                </div>
            </a>
            <a href="{{secure_url('/home/adverts/edit/'.$advert->id.'/step2')}}" class="step">
                <i class="dollar icon"></i>
                <div class="content">
                    <div class="title">Прайс</div>
                    <div class="description">Укажите цены для городов</div>
                </div>
            </a>
            <a href="{{secure_url('/home/adverts/edit/'.$advert->id.'/step3')}}" class="step">
                <i class="play icon"></i>
                <div class="content">
                    <div class="title">Медиа</div>
                    <div class="description">Добавьте медиа-контент</div>
                </div>
            </a>
        </div>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form class="col-xs-12 body" method="POST"
              action="{{secure_url('/home/adverts/edit/step1')}}">
            {{csrf_field()}}
            <input type="hidden" value="{{$advert->id}}" name="advert">
            <div class="ui teal pointing below label">
                Название и категория объявления
            </div>
            <div class="ui big fluid action left icon input">
                <i class="teal add user icon"></i>
                <input autocomplete="off" autofocus maxlength="58" name="name"
                       value="{{$advert->name}}" placeholder="Название объявления" required type="text">
                <select id="categories" class="ui search dropdown" required name="category">
                    <option disabled="disabled" value="">Выберите категорию</option>
                    @foreach($categories as $categ)
                        <option value="{{$categ->id}}">{{$categ->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="ui teal pointing below label">
                Описание объявления
            </div>
            <textarea name="description" id="description" cols="30" rows="10" class="col-xs-12" minlength="200"
                      placeholder="Текст объявления" required style="float:none;">{{$advert->description}}</textarea>
            <button class="pull-right ui right labeled icon button">
                <i class="right arrow icon"></i>
                Следующий шаг
            </button>
        </form>
    </div>
@endsection
