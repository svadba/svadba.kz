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
        <div class="col-xs-12 margin-top-always priceBlock">
            {{csrf_field()}}
            @if($advert->advert_cits)
                <div class="ui teal pointing below label">Добавленные города</div>
                <div class="ui cards stackable four column grid added_cities">
                    @foreach($advert->advert_cits as $adv_cit)
                        <div class="card column" id="city-{{$adv_cit->id}}">
                            <div class="content">
                                <div class="header"><i class="marker teal icon"></i>{{$adv_cit->cit->name}}</div>
                                <input type="hidden" value="{{$adv_cit->cit->id}}" class="addedCit">
                                <div class="description">
                                    <div class="ui pointing basic large label">
                                        от {{$adv_cit->price}}
                                    </div>
                                </div>
                            </div>
                            <div class="ui red bottom attached button delAdvCit"
                                 id="del-{{$advert->id}}-{{$adv_cit->id}}">
                                <i class="remove icon"></i>
                                Удалить
                            </div>
                        </div>
                    @endforeach
                    @endif
                </div>
                <div class="ui teal pointing below label">
                    Добавить город для объявления
                </div>
                <div id="form_adv-{{$advert->id}}" class="ui form segment price priceWithoutClose add_cit">
                    <div class="two fields">
                        <div class="field">
                            <label><i class="teal marker icon"></i>Город объявления</label>
                            <select id="cities" class="ui search dropdown" name="advert_cits" required>
                                @foreach($cities as $cit)
                                    <option value="{{$cit->id}}">{{$cit->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="field">
                            <label><i class="teal money icon"></i>Цена от</label>
                            <input placeholder="от" placeholder="цена от" type="number" name="price"
                                   class="prices"
                                   autocomplete="off">
                        </div>
                    </div>
                    <div class="ui submit teal button"><i class="plus icon"></i>Добавить город</div>
                    <div class="ui error message"></div>
                </div>
                <a href="{{secure_url('/home/adverts/edit/' . $advert->id . '/step3')}}"
                   class="pull-right ui right labeled icon button margin-top-always">
                    <i class="right arrow icon"></i>
                    Следующий шаг
                </a>
        </div>
    </div>
@endsection
