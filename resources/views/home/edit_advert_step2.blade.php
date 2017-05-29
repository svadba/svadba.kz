@extends('layouts.app')

@section('content')
    <div class="body row text-center">
        <div class="ui tablet stackable steps">
            <a href="{{secure_url('/home/adverts/edit/'.$advert->id.'/step1')}}" class="step">
                <i class="edit icon"></i>
                <div class="content">
                    <div class="title">Описание</div>
                    <div class="description">Введите основную информацию</div>
                </div>
            </a>
            <a href="{{secure_url('/home/adverts/edit/'.$advert->id.'/step2')}}" class="active step">
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
        <form class="col-xs-12 margin-top-always priceBlock" method="POST"
              action="{{secure_url('/home/adverts/edit/step2')}}">
            {{csrf_field()}}
            <input type="hidden" value="{{$advert->id}}" name="advert">
            @if($advert->advert_cits)
                <div class="ui divided items">
                    <div class="ui top attached label">Добавленные города</div>
                    @foreach($advert->advert_cits as $adv_cit)
                        <div class="item">
                            <div class="content">
                                <div class="ui teal header">{{$adv_cit->cit->name}}</div>
                                <div class="meta">
                                    <span class="cinema">от {{$adv_cit->price}} до {{$adv_cit->price_two}}</span>
                                </div>
                                <div class="extra">
                                    <div class="ui label">
                                        @if($adv_cit->dogovor)
                                            <i class="green toggle on icon"></i>
                                        @else
                                            <i class="toggle off icon"></i>
                                        @endif
                                        Договорная
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @endif
                </div>
                <div class="ui form segment price priceWithoutClose">
                    <div class="two fields">
                        <div class="field">
                            <label>Цена от</label>
                            <input placeholder="от" placeholder="цена от" type="number" name="prices[0]" class="prices"
                                   autocomplete="off">
                        </div>
                        <div class="field">
                            <label>Цена до</label>
                            <input placeholder="до" placeholder="цена до" type="number" autocomplete="off"
                                   class="prices_two">
                        </div>
                    </div>
                    <div class="field">
                        <label>Город объявления</label>
                        <select id="cities" class="ui search dropdown" name="advert_cits[0]" required>
                            @foreach($cities as $cit)
                                <option value="{{$cit->id}}">{{$cit->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="inline field">
                        <div class="ui checkbox">
                            <input type="checkbox" name="dogovor[0]" tabindex="0" class="checkbox"
                                   id="checkbox0">
                            <label for="checkbox0">Договорная</label>
                        </div>
                    </div>
                    <div class="ui error message"></div>
                </div>
                <button class="fluid ui button createPrice" type="button">
                    <i class="plus icon"></i> Добавить новый город
                </button>
                <div class="two ui buttons margin-top-always">
                    <button class="ui positive basic button">
                        <i class="checkmark icon"></i>
                        <input type="submit" value="Перейти к шагу 3">
                    </button>
                </div>
        </form>
    </div>
@endsection
