@extends('layouts.app')

@section('content')
    <div class="body row">
        <div class="col-xs-12 col-sm-3">
            <div class="anketa col-xs-12">
                <img alt="{{$contractor->name}}" class="center-block img-circle img-responsive margin-top-always"
                     src="//svadba.kz/upload/adverts/thumbs/ncvTZB1xDP1446.jpeg">
                <div class="input-group margin-top-always">
                    <span class="input-group-addon" id="basic-addon1">И</span>
                    <input type="text" class="form-control" placeholder="{{$contractor->name}}"
                           aria-describedby="basic-addon1">
                </div>
                <div class="input-group margin-top-always">
                    <span class="input-group-addon" id="basic-addon2">Ф</span>
                    <input type="text" class="form-control" placeholder="{{$contractor->surname}}"
                           aria-describedby="basic-addon2">
                </div>
                <div class="input-group margin-top-always">
                    <span class="input-group-addon" id="basic-addon3">@</span>
                    <input type="text" class="form-control" placeholder="{{$contractor->email}}"
                           aria-describedby="basic-addon3">
                </div>
                <a class="btn btn-default btn-lg btn-block margin-top-always margin-bottom-always"
                   href="{{url('/home/adverts/add')}}">+ Добавить объявление</a>
            </div>
        </div>
        <div class="col-xs-12 col-sm-9 ui cards stackable three column grid">
            <h2 class="col-xs-12 text-center xs-margin-top">Объявления</h2>
            @foreach($contractor->adverts as $advert)
                <div class="card column" id="advert-{{$advert->id}}">
                    <div class="content">
                        <img class="right floated tiny ui image"
                             src="//svadba.kz/upload/adverts/thumbs/ncvTZB1xDP1446.jpeg">
                        <div class="header">
                            {{$advert->name}}
                        </div>
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
                            <div class="ui basic red button" id="del_adv-{{$advert->id}}">Удалить</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
