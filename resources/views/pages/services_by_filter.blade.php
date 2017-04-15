@extends('layouts.app')


@section('content')
	<div class="row">
		<div class="col-xs-12">
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="#">Фильтры</a>
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
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
								<input type="text" id="amount" readonly style="border:0; color:#0ABAB5; font-weight:bold;text-align: center">
								<div id="slider-range"></div>
							</div>
							<button type="submit" class="btn btn-default">Найти</button>
						</form>
					</div>
				</div><!-- /.container-fluid -->
			</nav>
		</div>
		<div class="col-xs-12">
			@foreach($adverts as $advert)
			<div class="col-xs-12 col-sm-6 col-md-3 article-block-outer">
				<div class="article-block w100">
					<div class="article-block-inner">
						<a href="{{url('/advert/'.$advert->id)}}">
							<!-- <span class="views_count block"><span class="iblock">948</span></span> -->
							<img src="{{asset($advert->photos->first()['path'])}}" class="img-responsive" nopin="nopin"  alt="{{$advert->name}}" title="{{$advert->name}}"></a>
						<div class="heading iblock">
							<div><a href="{{url('/services/filter?category='.$advert->advert_categor->id.'&city='.$city_filter)}}" class="pink f13 bold">{{$advert->advert_categor->name}}</a>
							</div>
							<div class="title"><a href="{{url('/advert/'.$advert->id)}}" class="link">{{$advert->name}}</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
		{{$adverts->appends(['sort' => $sort_filter, 'city' => $city_filter, 'category' => $category_filter])->links()}}
	</div>
@endsection

