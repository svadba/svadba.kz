@extends('layouts.app')
@section('content')
<div class="row body">
	<div class="col-xs-12 col-sm-9">
		<img src="{{secure_asset($ad->photo_main())}}" class="img-responsive img-circle img-advert col-xs-12 col-sm-3" alt="Responsive image">
		<h1 >{{$ad->name}}</h1>
		<h4>Рейтинг: {{$ad->rating}}
			<div class='starrr' id='star1'></div>
		</h4>
		<h4>Категория:
			<a href="{{secure_url('/services/filter/?category='.$ad->advert_categor->id)}}">{{$ad->advert_categor->name}}</a>
		</h4>
		<h4>Города:
			@foreach($ad->advert_cits as $adv_cit)
			<a href="{{secure_url('/cities/'.$adv_cit->cit->name_eng)}}">{{$adv_cit->cit->name}}</a>
			@endforeach
		</h4>
		<h4>
			Цена:
			@if($adv_cit->dogovor == 1) Договорная @else от {{$adv_cit->price}} @endif
		</h4>
		<div id="{{$ad->id}}" class="ui teal button buy-btn margin-bottom-always" id="">Добавить в корзину</div>
		<div class="col-xs-12 text-center" style="border-top: 3px solid rgb(166, 230, 228); padding: 0;">
			<h4 class="margin-top-always">Информация</h4>
			<p>
				<?php echo $ad->description ; ?>
			</p>
			<div class="col-xs-12 margin-top-always" style="padding: 0;">
				<h4 class="margin-top-always">Фотографии ({{$ad->photos->count()}})</h4>
				@foreach($ad->photos as $photo)
				<a class="col-xs-3 photo-advert" data-lightbox="roadtrip" href="{{secure_asset($photo->path)}}" style="background-image: url({{secure_asset($photo->path)}});"></a>
				@endforeach
			</div>
			<div class="col-xs-12 margin-top-always" style="padding: 0;">
				<h4 class="margin-top-always">Видео ({{$ad->videos->count()}})</h4>
				@foreach($ad->videos as $video)
				<div class="col-xs-6">
					<iframe class="center-block" src="{{$video->path}}" frameborder="0" allowfullscreen></iframe>
				</div>
				@endforeach
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-3">
		<div class="col-xs-12 padding-0-always ui special cards">
			@foreach($other_adverts as $other_adv)
			<div class="card">
				<div class="blurring dimmable image">
					<div class="ui dimmer">
						<div class="content">
							<div class="center">
								<div id="{{$other_adv->id}}" class="ui inverted button buy-btn">Добавить в корзину</div>
								<a href="{{secure_url('/advert/'.$other_adv->id.'?=city'.$city_filter)}}" class="ui primary button margin-top-always">Подробнее</a>
							</div>
						</div>
					</div>
					@if($other_adv->photos->first())
						<img src="{{secure_asset('upload/begests/thumbs/'.$other_adv->photos->first()['name'].'.'.$other_adv->photos->first()['ext'])}}" alt="{{$other_adv->name}}" title="{{$other_adv->name}}">
					@else
						<img src="{{secure_asset('images/no-avatar.png')}}" alt="{{$other_adv->name}}" title="{{$other_adv->name}}">
					@endif

				</div>
				<div class="content">
					<a href="{{secure_url('/advert/'.$other_adv->id)}}" class="header">{{$other_adv->name}}</a>
					<div class="meta">
						<a href="{{secure_url('/services/filter?category='.$other_adv->advert_categor->id)}}">{{$other_adv->advert_categor->name}}</a>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>
@endsection

