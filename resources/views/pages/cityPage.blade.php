@extends('layouts.app')


@section('content')
<div class="row body">
	<div class="col-xs-12 text-center package">
		<!--
		<div class="massive ui button">
			<button class="circular ui icon button">
				<i class="icon plus"></i>
			</button>
		</div>

		<p class="margin-top-always">Соберите индивидуальный свадебный пакет</p>
		<p>или</p>
		<p>Выберите из наших предложений для Вас</p>-->
		@foreach($combos as $combo)
			<div class="col-xs-12 col-sm-4">
				<div class="col-xs-12 padding-0-always" style="background: rgba(111, 151, 213, .6); border-radius: 54px 6px 0 54px;">
					<div class="col-xs-3 padding-0-always">
						<img src="{{secure_asset($combo->photo_path)}}" alt="" class="img-responsive">
					</div>
					<div class="col-xs-9 padding-0-always">
						<h2 style="color: #191e23; margin-top: 6px; margin-bottom: 6px;">{{$combo->name}}</h2>
						<p style="color: #191e23; font-size: 18px;">{{$combo->price}}ТГ</p>
					</div>
				</div>
				<div class="col-xs-10 padding-0-always" style="float: right; background: #f8f8f8;">
					<ul style="list-style: none; padding: 0; color: #23282d; border-bottom-left-radius: 6px; border-bottom-right-radius: 6px;">
						@foreach($combo->combo_cits as $cit)
							@foreach($cit->categories as $categ)
								<li>{{$categ->name}}</li>
							@endforeach
						@endforeach
					</ul>
					@foreach($combo->combo_cits as $cit2)
						<a href="{{secure_url('combo/'.$combo->id.'/'.$cit2->id)}}" class="col-xs-10 col-lg-5 margin-bottom-always ui primary button" style="float: none;">Подробнее</a>
					@endforeach
				</div>
			</div>
		@endforeach
	</div>
	<div class="col-xs-12">
		<h2 class="text-center margin-top-always">Каталог компаний и специалистов по основным категориям</h2>
		@foreach($categories as $serv)
		<div class="col-xs-12 col-sm-2 margin-bottom-always text-center">
			<a class="ui small image" href="{{secure_url('/services/filter?category='.$serv->id.'&city='.$nowCity->id)}}">
				<img src="{{secure_asset('images/icons/'.$serv->name_eng.'.png')}}" alt="">
			</a>
		</div>
		@endforeach
	</div>
	<div class="col-xs-12">
		<div class="col-xs-12 ui special cards">
			@foreach($topsTwo as $toper2)
			<div class="col-xs-12 col-sm-6 col-md-3 padding-0-always">
				<div class="card">
					<div class="blurring dimmable image">
						<div class="ui dimmer">
							<div class="content">
								<div class="center">
									<div id="{{$toper2->advert->id}}" class="ui inverted button buy-btn">Добавить в корзину</div>
									<a href="{{secure_url('/advert/'.$toper2->advert->id.'?city='.$nowCity->id)}}" class="ui primary button margin-top-always">Подробнее</a>
								</div>
							</div>
						</div>
						@if($toper2->advert->photos->first())
							<img src="{{secure_asset('upload/begests/thumbs/'.$toper2->advert->photos->first()['name'].'.'.$toper2->advert->photos->first()['ext'])}}" alt="{{$toper2->advert->name}}" title="{{$toper2->advert->name}}">
						@else
							<img src="{{secure_asset('images/no-avatar.png')}}" alt="{{$toper2->advert->name}}" title="{{$toper2->advert->name}}">
						@endif
					</div>
					<div class="content">
						<a href="{{secure_url('/advert/'.$toper2->advert->id)}}" class="header">{{$toper2->advert->name}}</a>
						<div class="meta">
							<a href="{{secure_url('/services/filter?category='.$toper2->advert->advert_categor->id)}}">{{$toper2->advert->advert_categor->name}}</a>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
	<div class="col-xs-12">
		<div class="col-xs-12 ui special cards">
			@foreach($topsThree as $toper3)
			<div class="col-xs-12 col-sm-6 col-md-3 padding-0-always">
				<div class="card">
					<div class="blurring dimmable image">
						<div class="ui dimmer">
							<div class="content">
								<div class="center">
									<div id="{{$toper3->advert->id}}" class="ui inverted button buy-btn">Добавить в корзину</div>
									<a href="{{secure_url('/advert/'.$toper3->advert->id.'?city='.$nowCity->id)}}" class="ui primary button margin-top-always">Подробнее</a>
								</div>
							</div>
						</div>
						@if($toper3->advert->photos->first())
							<img src="{{secure_asset('upload/begests/thumbs/'.$toper3->advert->photos->first()['name'].'.'.$toper3->advert->photos->first()['ext'])}}" alt="{{$toper3->advert->name}}" title="{{$toper3->advert->name}}">
						@else
							<img src="{{secure_asset('images/no-avatar.png')}}" alt="{{$toper3->advert->name}}" title="{{$toper3->advert->name}}">
						@endif
					</div>
					<div class="content">
						<a href="{{secure_url('/advert/'.$toper3->advert->id)}}" class="header">{{$toper3->advert->name}}</a>
						<div class="meta">
							<a href="{{secure_url('/services/filter?category='.$toper3->advert->advert_categor->id)}}">{{$toper3->advert->advert_categor->name}}</a>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>


@endsection

