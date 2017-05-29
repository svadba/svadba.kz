@extends('layouts.app')

@section('content')
    <div class="body row">
        <div class="col-xs-12 col-sm-3">
            <div style="background: #e9e9e9; border:1px solid #d3d3d3; padding:0 20px;" class="anketa col-xs-12">
                <img alt="{{$contractor->name}}" class="center-block img-circle img-responsive margin-top-always"
                     @if($contractor->ava_path) src="{{secure_asset($contractor->ava_path)}}" @else src="{{secure_asset('images/no-avatar.png')}}" @endif >
                <h5 style="color:black;margin:10px 0px 5px;"><i style="font-size: 2em; color: #00aeef;" class="user icon"></i>Личная информация</h5>
                <span class="input input--fumi">
					<input class="input__field input__field--fumi" type="text" value="{{$contractor->name}}" id="inputname{{$contractor->id}}" />
					<label class="input__label input__label--fumi" for="inputname{{$contractor->id}}">
						<i class="info icon icon--fumi"></i>
						<span style="font-size: 1.2em;" class="input__label-content input__label-content--fumi">Имя</span>
					</label>
				</span>
                <span class="input input--fumi">
					<input class="input__field input__field--fumi" type="text" value="{{$contractor->surname}}" id="inputfam{{$contractor->id}}"/>
					<label class="input__label input__label--fumi" for="inputfam{{$contractor->id}}">
						<i class="info icon icon--fumi"></i>
						<span style="font-size: 1.2em;" class="input__label-content input__label-content--fumi">Фамилия</span>
					</label>
				</span>
                <span class="input input--fumi">
					<input class="input__field input__field--fumi" type="text" value="{{$contractor->email}}" id="inputemail{{$contractor->id}}"/>
					<label class="input__label input__label--fumi" for="inputemail{{$contractor->id}}">
						<i class="at icon icon--fumi"></i>
						<span style="font-size: 1.2em;" class="input__label-content input__label-content--fumi">Почтовый адрес</span>
					</label>
				</span>
                <a class="btn btn-default btn-lg btn-block margin-top-always margin-bottom-always"
                   href="{{url('/home/adverts/add/'.$contractor->id.'/step1')}}">+ Добавить объявление
                </a>
            </div>
        </div>

        <div class="col-xs-12 col-sm-9 ui cards">
            <h2 class="col-xs-12 text-center xs-margin-top">Объявления</h2>
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
                            <div class="ui rating" data-rating="{{$advert->rating}}" data-max-rating="5"></div>
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
                            <div class="ui basic red button delete_advert" data-name="{{$advert->name}}" id="del_adv-{{$advert->id}}">Удалить</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
