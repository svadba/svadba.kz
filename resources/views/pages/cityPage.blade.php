@extends('layouts.app')


@section('content')
<div class="row body">
	<div class="col-xs-12">
		<h2 class="text-center margin-top-always">Топы 1</h2>
		<div class="col-xs-12 padding-0-always ui special cards">
			@foreach($topsOne as $toper)
			<div class="col-xs-12 col-sm-6 col-md-3 padding-0-always">
				<div class="card">
					<div class="blurring dimmable image">
						<div class="ui dimmer">
							<div class="content">
								<div class="center">
									<div  id="{{$toper->advert->id}}" class="ui inverted button buy-btn">Добавить в корзину</div>
									<a href="{{url('/advert/'.$toper->advert->id)}}" class="ui primary button margin-top-always">Подробнее</a>
								</div>
							</div>
						</div>
						<img src="{{asset($toper->advert->photos->first()['path'])}}" alt="{{$toper->advert->name}}" title="{{$toper->advert->name}}">
					</div>
					<div class="content">
						<a href="{{url('/advert/'.$toper->advert->id)}}" class="header">{{$toper->advert->name}}</a>
						<div class="meta">
							<a href="{{url('/services/filter?category='.$toper->advert->advert_categor->id)}}">{{$toper->advert->advert_categor->name}}</a>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
	<div class="col-xs-12">
		<h2 class="text-center margin-top-always">Каталог компаний и специалистов по основным категориям</h2>
		@foreach($categories as $serv)
		<div class="col-xs-12 col-sm-2 margin-bottom-always text-center">
			<a class="ui small image" href="{{url('/services/filter?category='.$serv->id.'&city='.$nowCity->id)}}">
				<img src="{{asset('images/icons/'.$serv->name_eng.'.png')}}" alt="">
			</a>
		</div>
		@endforeach
	</div>

	<div class="col-xs-12">
		<h2 class="text-center margin-top-always">Топы 2</h2>
		<div class="col-xs-12 ui special cards">
			@foreach($topsTwo as $toper2)
			<div class="col-xs-12 col-sm-6 col-md-3 padding-0-always">
				<div class="card">
					<div class="blurring dimmable image">
						<div class="ui dimmer">
							<div class="content">
								<div class="center">
									<div id="{{$toper->advert->id}}" class="ui inverted button">Добавить в корзину</div>
									<a href="{{url('/advert/'.$toper2->advert->id)}}" class="ui primary button margin-top-always">Подробнее</a>
								</div>
							</div>
						</div>
						<img src="{{asset($toper2->advert->photos->first()['path'])}}" alt="{{$toper2->advert->name}}" title="{{$toper2->advert->name}}">
					</div>
					<div class="content">
						<a href="{{url('/advert/'.$toper2->advert->id)}}" class="header">{{$toper2->advert->name}}</a>
						<div class="meta">
							<a href="{{url('/services/filter?category='.$toper2->advert->advert_categor->id)}}">{{$toper2->advert->advert_categor->name}}</a>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
	<div class="col-xs-12">
		<h2 class="text-center margin-top-always">Топы 3</h2>
		<div class="col-xs-12 ui special cards">
			@foreach($topsThree as $toper3)
			<div class="col-xs-12 col-sm-6 col-md-3 padding-0-always">
				<div class="card">
					<div class="blurring dimmable image">
						<div class="ui dimmer">
							<div class="content">
								<div class="center">
									<div id="{{$toper->advert->id}}" class="ui inverted button buy-btn">Добавить в корзину</div>
									<a href="{{url('/advert/'.$toper3->advert->id)}}" class="ui primary button margin-top-always">Подробнее</a>
								</div>
							</div>
						</div>
						<img src="{{asset($toper3->advert->photos->first()['path'])}}" alt="{{$toper3->advert->name}}" title="{{$toper3->advert->name}}">
					</div>
					<div class="content">
						<a href="{{url('/advert/'.$toper3->advert->id)}}" class="header">{{$toper3->advert->name}}</a>
						<div class="meta">
							<a href="{{url('/services/filter?category='.$toper3->advert->advert_categor->id)}}">{{$toper3->advert->advert_categor->name}}</a>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>


@endsection

