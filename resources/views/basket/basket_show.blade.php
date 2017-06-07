@extends('layouts.app')


@section('content')

    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    <div class="oneHalfBody center-block">
        <h2 class="ui teal header">
            <i class="circular shopping basket icon"></i>
            <div class="content">
                Ваша корзина
                <div class="sub header">Определитесь окончательно с выбранными специалистами и оформите заявку ниже
                </div>
            </div>
        </h2>
        @if($combo && $combo_cit && $combo_cook)
            <div id="combo" class="ui piled segment" style="border-color:#0ABAB5;">
                <h4 class="ui header items">
                    <div class="ui item">
                        <div class="ui tiny circular image">
                            <img src="{{secure_asset($combo->photo_path)}}">
                        </div>
                        <div class="middle aligned content">
                            <div class="header">{{$combo->name}}</div>
                            <button class="negative compact ui right floated labeled icon button remove_combo">
                                <i class="remove icon"></i> Удалить пакет
                            </button>
                        </div>
                    </div>
                </h4>
                <div class="ui stackable five column grid">
                    <input type="hidden" name="combo" value="{{$combo->id}}">
                    <input type="hidden" name="combo_cit" value="{{$combo_cit->id}}">
                    @foreach($combo_cit->combo_categors as $combo_categor2)
                        @if(array_key_exists($combo_categor2->id, $combo_cook))
                            @foreach($combo_categor2->adverts as $advert)
                                @if( $combo_cook[$combo_categor2->id] == $advert->id )
                                    <div class="column baseAdvDiv-{{$combo_categor2->id}}" id="baseAd-{{$advert->id}}">
                                        <div class="ui card">
                                            <div class="image">
                                                <img src="{{secure_asset($advert->photo_main())}}" alt="">
                                            </div>
                                            <div class="content">
                                                <div class="header">{{$advert->name}}</div>
                                                <div class="meta">
                                                    <span class="date">{{$combo_categor2->advert_categor->name}}</span>
                                                </div>
                                            </div>
                                            <div class="extra content">
                                                <a id="change-{{$combo_categor2->id}}-{{$advert->id}}"
                                                   class="fluid ui basic teal button changeComboAdvertBasket">
                                                    <i class="exchange icon"></i>Изменить</a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </div>
            </div>
            @foreach($combo_cit->combo_categors as $combo_categor3)
                <div id="combomodal-{{$combo_categor3->id}}" class="ui basic long scrolling modal combo_modal">
                    <div class="ui icon header">
                        <i class="exchange icon"></i>
                        Редактирование категории пакета
                    </div>
                    <div class="content">
                        <div class="ui link cards">
                            @foreach($combo_categor3->adverts as $advert)
                                <div class="card">
                                    <div class="image">
                                        <img id="chAdvImg-{{$advert->id}}" src="{{secure_url($advert->photo_main())}}">
                                    </div>
                                    <div class="content">
                                        <div id="chAdvName-{{$advert->id}}" class="header">{{$advert->name}}</div>
                                        <div class="meta">
                                            <a id="chAdvCategName-{{$advert->id}}">{{$combo_categor3->advert_categor->name}}</a>
                                        </div>
                                    </div>
                                    <div class="extra content">
                                        <span class="right floated">
                                            <div class="ui heart rating" data-rating="{{$advert->rating}}"
                                                 data-max-rating="5"></div>
                                        </span>
                                        <span><i class="unhide icon"></i>{{$advert->views}}</span>
                                    </div>
                                    <div class="extra content">
                                        <div id="setComAdv-{{$combo_categor3->id}}-{{$advert->id}}"
                                             class="fluid ui basic green button set_change_adv_combo">Выбрать
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="actions">
                        <div class="ui red basic cancel inverted button">
                            <i class="remove icon"></i>
                            Не изменять
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
        <div class="ui tall stacked segment">
            <div class="ui stackable four column grid">
                @if($basket_adv)
                    @foreach($basket_adv as $bask)
                        <div class="column" id="bask_{{$bask->id}}">
                            <div class="ui card">
                                <a class="image" href="{{secure_url('advert/'.$bask->id)}}">
                                    @if($bask->photos->first())
                                        <img src="{{secure_asset('upload/begests/thumbs/'.$bask->photos->first()['name'].'.'.$bask->photos->first()['ext'])}}"
                                             alt="{{$bask->name}}" title="{{$bask->name}}">
                                    @else
                                        <img src="{{secure_asset('images/no-avatar.png')}}" alt="{{$bask->name}}"
                                             title="{{$bask->name}}">
                                    @endif
                                </a>
                                <div class="content">
                                    <a href="{{secure_url('advert/'.$bask->id)}}" class="header">{{$bask->name}}</a>
                                    <div class="meta">
                                        <a href="{{secure_url('services/filter?category='.$bask->advert_categor_id)}}"
                                           class="date">{{$bask->advert_categor->name}}</a>
                                    </div>
                                </div>
                                <div class="extra content">
                                    <a id='{{$bask->id}}' class="fluid ui basic red button del_from_bask">
                                        <i class="remove icon"></i> Удалить</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="ui horizontal divider">Оформить заявку</div>
        <form class="ui form segment" action="{{secure_url('basket/sent')}}" method="POST">
            {{ csrf_field() }}
            <div class="two fields">
                <div class="field">
                    <label>Имя</label>
                    <input placeholder="Имя" name="name" type="text" value="{{Request::old('name')}}">
                </div>
                <div class="field">
                    <label>Город</label>
                    <select class="ui search dropdown" name="city">
                        @foreach($cities as $cit)
                            <option value="{{$cit->id}}">{{$cit->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="two fields">
                <div class="field">
                    <label>Телефон</label>
                    <input placeholder="Телефон" name="phone" type="number" value="{{Request::old('phone')}}">
                </div>
                <div class="field">
                    <label>Email</label>
                    <input placeholder="Email" type="email" name="email" value="{{Request::old('email')}}">
                </div>
            </div>
            <button type="submit" class="ui primary submit button">Отправить</button>
            <div class="ui error message"></div>
        </form>
    </div>
@endsection

