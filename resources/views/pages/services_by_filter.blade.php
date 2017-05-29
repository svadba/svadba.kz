@extends('layouts.app')


@section('content')
<div class="row body">
	<div class="col-xs-12">
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-filter-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">Фильтры</a>
				</div>
				<div class="collapse navbar-collapse" id="bs-filter-navbar-collapse-1">
					<form action="/services/filter" method="GET" class="navbar-form navbar-left">
						<div class="form-group">
							<select class="form-control" name="category">
								<option value="">Выбрать категорию</option>
								@foreach($categories as $categ)
								@if($categ->id == $category_filter)
								<option selected="selected" value="{{$categ->id}}">{{$categ->name}}</option>
								@else
								<option value="{{$categ->id}}">{{$categ->name}}</option>
								@endif
								@endforeach
							</select>
							<select class="form-control" name="city">
								<option value="">Выбрать город</option>
								@foreach($cities as $cit_one)
								@if($cit_one->id == $city_filter)
								<option selected="selected" value="{{$cit_one->id}}">{{$cit_one->name}}</option>
								@else
								<option value="{{$cit_one->id}}">{{$cit_one->name}}</option>
								@endif
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<input type="text" id="amount" readonly style="border:0; color:#0ABAB5; font-weight:bold; text-align: center">
							<div id="slider-range"></div>
						</div>
						<button type="submit" class="btn btn-default">Найти</button>
					</form>
				</div>
			</div><!-- /.container-fluid -->
		</nav>
	</div>
	<div class="col-xs-12">
		<div class="col-xs-12 padding-0-always ui special cards">
			@foreach($adverts as $advert)
			<div class="col-xs-12 col-sm-6 col-md-3 padding-0-always">
				<div class="card">
					<div class="blurring dimmable image">
						<div class="ui dimmer">
							<div class="content">
								<div class="center">
									<div id="{{$advert->id}}" class="ui inverted button buy-btn">Добавить в корзину</div>
									<a href="{{secure_url('/advert/'.$advert->id.'?city='.$city_filter)}}" class="ui primary button margin-top-always">Подробнее</a>
								</div>
							</div>
						</div>
						@if($advert->photos->first())
							<img src="{{secure_asset('upload/begests/thumbs/'.$advert->photos->first()['name'].'.'.$advert->photos->first()['ext'])}}" alt="{{$advert->name}}" title="{{$advert->name}}">
						@else
							<img src="{{secure_asset('images/no-avatar.png')}}" alt="{{$advert->name}}" title="{{$advert->name}}">
						@endif

					</div>
					<div class="content">
						<a href="{{secure_url('/advert/'.$advert->id)}}" class="header">{{$advert->name}}</a>
						<div class="meta">
							<a href="{{secure_url('/services/filter?category='.$advert->advert_categor->id.'&city='.$city_filter)}}">{{$advert->advert_categor->name}}</a>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
	{{$adverts->appends(['sort' => $sort_filter, 'city' => $city_filter, 'category' => $category_filter])->links()}}
</div>
@endsection

