@extends('layouts.app')

@section('content')
    <div class="body">
        <div class="ui stackable grid">
            <div class="four wide column">
                <div class="ui raised card">
                    <div class="blurring dimmable image">
                        <div class="ui inverted dimmer">
                            <div class="content">
                                <div class="center">
                                    <div class="ui teal button"><i class="photo icon"></i>Изменить</div>
                                </div>
                            </div>
                        </div>
                        <img alt="{{$contractor->name}}"
                             @if($contractor->ava_path) src="{{secure_asset($contractor->ava_path)}}"
                             @else src="{{secure_asset('images/no-avatar.png')}}" @endif >
                    </div>
                    <div class="content">
                        <div class="ui pointing below teal label">
                            Имя
                        </div>
                        <div class="ui fluid left icon input">
                            <i class="user icon"></i>
                            <input placeholder="Имя" type="text" value="{{$contractor->name}}">
                        </div>
                        <div class="ui pointing below teal label" style="margin-top: 1em;">
                            Фамилия
                        </div>
                        <div class="ui fluid left icon input">
                            <i class="users icon"></i>
                            <input placeholder="Фамилия" type="text" value="{{$contractor->surname}}">
                        </div>
                        <div class="ui pointing below teal label" style="margin-top: 1em;">
                            Email
                        </div>
                        <div class="ui fluid left icon input">
                            <i class="at icon"></i>
                            <input placeholder="Email" type="email" value="{{$contractor->email}}">
                        </div>
                        <div class="ui pointing below teal label" style="margin-top: 1em;">
                            Номер
                        </div>
                        <div class="ui fluid left icon input">
                            <i class="call icon"></i>
                            <input placeholder="Номер" type="number" value="">
                        </div>
                        <a class="ui label margin top always">
                            +77784260014
                            <i class="delete icon"></i>
                        </a>
                        <a class="ui label margin top always">
                            +77784260014
                            <i class="delete icon"></i>
                        </a>
                        <a class="ui label margin top always">
                            +77784260014
                            <i class="delete icon"></i>
                        </a>
                    </div>
                    <a class="ui bottom attached blue button"
                       href="{{url('/home/adverts/add/'.$contractor->id.'/step1')}}">
                        <i class="add icon"></i>
                        Добавить объявление
                    </a>
                </div>
            </div>
            <div class="twelve wide column">
                <h3 class="ui block center aligned header"><i class="newspaper teal icon"></i>Объявления</h3>
                <div class="ui cards">
                    @foreach($contractor->adverts as $advert)
                        <div class="card" id="advert-{{$advert->id}}">
                            <div class="content">
                                <img class="right floated tiny ui image"
                                     src="{{$advert->photo_main()}}">
                                <div class="header">{{$advert->name}}</div>
                                <div class="meta">
                                    <i class="unhide icon"></i> {{$advert->views}}
                                </div>
                                <div class="description">
                                    <div class="ui heart rating" data-rating="{{$advert->rating}}"
                                         data-max-rating="5"></div>
                                </div>
                            </div>
                            <div class="extra content text-center">
                        <span class="left floated">
                            <i class="music icon"></i> {{$advert->musics->count()}}
                        </span>
                                <span>
                            <i class="photo icon"></i> {{$advert->photos->count()}}
                        </span>
                                <span class="right floated">
                            <i class="film icon"></i> {{$advert->videos->count()}}
                        </span>
                            </div>
                            <div class="extra content">
                                <div class="ui two buttons">
                                    <a class="ui basic green button"
                                       href="{{url('/home/adverts/'.$advert->id)}}">Просмотреть</a>
                                    <div class="ui basic red button delete_advert" data-name="{{$advert->name}}"
                                         id="del_adv-{{$advert->id}}">Удалить
                                    </div>
                                </div>
                            </div>
                            <a class="ui bottom attached blue button"
                               href="{{url('/home/adverts/edit/'.$advert->id.'/step1')}}">
                                <i class="edit icon"></i>
                                Редактировать объявление
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
