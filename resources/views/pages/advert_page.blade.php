@extends('layouts.app')
@section('content')
    <div class="body">
        <div class="ui stackable grid">
            <div class="eight wide tablet four wide computer column">
                <div class="ui raised segment">
                    <img class="ui fluid rounded bordered image" src="{{secure_asset($ad->photo_main())}}" alt="">
                </div>
            </div>
            <div class="eight wide column">
                <div class="ui raised segment">
                    <h1 class="ui header" style="overflow: auto;">
                        {{$ad->name}}
                        <button id="{{$ad->id}}" class="ui right floated primary button buy-btn">Добавить в корзину
                        </button>
                    </h1>
                </div>
                <div class="ui raised segment" style="padding: 0;">
                    <table class="ui tablet stackable inverted teal very padded center aligned table">
                        <thead>
                        <tr>
                            <th>Рейтинг</th>
                            <th>Категория</th>
                            <th>Города</th>
                            <th>Цена</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <? $check = true; ?>
                            @foreach($ad->advert_cits as $adv_cit)
                                <td>
                                    @if($check)
                                        <div class="ui heart rating" data-rating="{{$ad->rating}}"
                                             data-max-rating="5"></div>
                                    @endif
                                </td>
                                <td>
                                    @if($check)
                                        <a href="{{secure_url('/services/filter/?category='.$ad->advert_categor->id)}}"
                                           style="color:#fff;">{{$ad->advert_categor->name}}</a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{secure_url('/cities/'.$adv_cit->cit->name_eng)}}"
                                       style="color:#fff;">{{$adv_cit->cit->name}}</a>

                                </td>
                                <td>
                                    @if($adv_cit->dogovor == 1) Договорная @else от {{$adv_cit->price}} @endif
                                </td>
                                <? $check = false; ?>
                            @endforeach
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="sixteen wide tablet four wide computer column"></div>
            <div class="eight wide column">
                <div class="ui raised segment">
                    <a class="ui blue ribbon label">Описание</a>
                    <p><?php echo $ad->description; ?></p>
                </div>
            </div>
            <div class="eight wide column ">
                <div class="ui raised segment">
                    <a class="ui red right ribbon label">Фотографии ({{$ad->photos->count()}})</a>
                    <div class="readyImages margin top always">
                        @foreach($ad->photos as $photo)
                            <div class="readyImage">
                                <a href="{{secure_asset($photo->path)}}" data-lightbox="roadtrip">
                                    <img src="{{secure_asset($photo->path)}}">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="eight wide column">
                <div class="ui raised segment">
                    <a class="ui orange ribbon label">Музыка</a>
                </div>
            </div>
            <div class="eight wide column">
                <div class="ui raised segment">
                    <a class="ui teal right ribbon label">Видео ({{$ad->videos->count()}})</a>
                    @foreach($ad->videos as $video)
                        <div class="eight wide column">
                            <iframe class="center-block" src="{{$video->path}}" frameborder="0"
                                    allowfullscreen></iframe>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="sixteen wide column">
                <div class="fluid big ui teal pointing below label">
                    Похожие услуги в данной категории
                </div>
                <div class="ui divided items">
                    @foreach($other_adverts as $other_adv)
                        <div class="item">
                            <div class="image">
                                @if($other_adv->photos->first())
                                    <img src="{{secure_asset('upload/begests/thumbs/'.$other_adv->photos->first()['name'].'.'.$other_adv->photos->first()['ext'])}}"
                                         alt="{{$other_adv->name}}" title="{{$other_adv->name}}">
                                @else
                                    <img src="{{secure_asset('images/no-avatar.png')}}" alt="{{$other_adv->name}}"
                                         title="{{$other_adv->name}}">
                                @endif
                            </div>
                            <div class="content">
                                <a href="{{secure_url('/advert/'.$other_adv->id)}}"
                                   class="header">{{$other_adv->name}}</a>
                                <a href="{{secure_url('/services/filter?category='.$other_adv->advert_categor->id)}}"
                                   class="meta">
                                    <span class="cinema">{{$other_adv->advert_categor->name}}</span>
                                </a>
                                <div class="description">
                                    <p></p>
                                </div>
                                <div class="extra">
                                    <a href="{{secure_url('/advert/'.$other_adv->id.'?=city'.$city_filter)}}"
                                       class="ui right floated primary button">
                                        Просмотреть
                                        <i class="right chevron icon"></i>
                                    </a>
                                    <div class="ui label">от 100 000 тг</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

