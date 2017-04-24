@extends('layouts.app')


@section('content')
	<div class="row body">
		<div class="col-xs-12 padding-bottom">
			<div class="col-xs-12 col-sm-9 xs-padding-right-left-hidden">
				<div class="col-xs-12 padding">
					<div class="col-xs-12 col-sm-3">
						<h2 class="text-center">Ваш город:</h2>
					</div>
					<div class="col-xs-12 col-sm-9 input-group">
						<select name="cities" id="cities" class="form-control">
							@foreach($cities as $cit)
								<option value="{{$cit->id}}">{{$cit->name}}</option>
							@endforeach
						</select>
						<span class="input-group-btn">
							<button class="btn btn-default" type="button">Выбрать!</button>
						</span>
					</div>
				</div>
				<div class="col-xs-12 col-sm-3 padding-right-0 text-center">
					<h1 style="font-size: 16px;">Центр свадебной индустрии</h1> - удобный сервис для подготовки к свадьбе! На нашем Республиканском портале Вы найдёте все необходимое для вашей свадьбы.
				</div>
				<div class="col-xs-12 col-sm-9 padding-left-0">
					<video autoplay="" loop="" muted=""><source type="video/mp4" src="{{asset('videos/main_video.mov')}}"></video>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 padding">
				<div class="col-xs-12" style="margin-left: -33px;">
					<a href="#" class="col-xs-3 icons"><img src="{{asset('images/icons/fb.png')}}" alt=""></a>
					<a href="#" class="col-xs-3 icons"><img src="{{asset('images/icons/inst.png')}}" alt=""></a>
					<a href="#" class="col-xs-3 icons"><img src="{{asset('images/icons/vk.png')}}" alt=""></a>
					<a href="#" class="col-xs-3 icons"><img src="{{asset('images/icons/yout.png')}}" alt=""></a>
				</div>
				<div class="col-xs-12 anketa">
					<h3 class="text-center padding-bottom" style="color: #fff; margin-top: 15px;">Добавьте свою анкету</h3>
					<div class="input-group padding-bottom-always">
						<span class="input-group-addon" id="basic-addon1" style="font-size: 20px;">Я</span>
						<select name="categories" id="categories" class="form-control"  aria-describedby="basic-addon1">
							@foreach($categories as $catg)
								<option value="{{$catg->id}}">{{$catg->name}}</option>
							@endforeach
						</select>
					</div>
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1" style="font-size: 20px;">В г.</span>
						<select name="cities" id="cities" class="form-control"  aria-describedby="basic-addon1">
							@foreach($cities as $cit)
								<option value="{{$cit->id}}">{{$cit->name}}</option>
							@endforeach
						</select>
					</div>
					<button type="button" class="btn btn-default btn-lg btn-block" style="margin-top: 15px; margin-bottom: 15px;">+ Добавить</button>
				</div>
			</div>
		</div>
		<div class="col-xs-12">
			<div class="ui steps center-block text-center">
				<a href="#cities-block" class="link step col-xs-12 col-sm-3 xs-padding-right-left-hidden">
					<div class="content">
						<img src="{{asset('images/icons/city.png')}}" alt="">
						<div class="title">Выбрать город</div>
						<div class="description">Выберите Ваш город проживания</div>
					</div>
				</a>
				<div class="link step col-xs-12 col-sm-3 xs-padding-right-left-hidden">
					<div class="content">
						<img src="{{asset('images/icons/marry.png')}}" alt="">
						<div class="title">Собрать пакет</div>
						<div class="description">Соберите пакет свадебных услуг</div>
					</div>
				</div>
				<div class="link step col-xs-12 col-sm-3 xs-padding-right-left-hidden">
					<div class="content">
						<img src="{{asset('images/icons/call.png')}}" alt="">
						<div class="title">Оставить заявку</div>
						<div class="description">После добавления всех услуг отправьте нам заявку</div>
					</div>
				</div>
				<div class="link step col-xs-12 col-sm-3 xs-padding-right-left-hidden">
					<div class="content">
						<img src="{{asset('images/icons/operator.png')}}" alt="">
						<div class="title">Бесплатная консультация</div>
						<div class="description">Если у вас возникнут трудности, нажмите кнопку звонок</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 cities-block" id="cities-block">
			<h2 class="text-center margin-top-always">Выберите Ваш город</h2>
			@foreach($cities as $cit)
				<div class="col-xs-12 col-sm-2">
					<a href="{{url('cities/'.$cit->name_eng)}}" class="center-block ui small circular rotate left reveal image">
						<img src="{{asset('images/icons/'.$cit->name_eng.'.png')}}" class="visible content">
						<img src="{{asset('images/icons/'.$cit->name_eng.'-flo.png')}}" class="hidden content">
					</a>
				</div>
			@endforeach
		</div>
	</div>
<div class="row">
	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
			<li data-target="#carousel-example-generic" data-slide-to="1"></li>
			<li data-target="#carousel-example-generic" data-slide-to="2"></li>
		</ol>

		<!-- Wrapper for slides -->
		<div class="carousel-inner" role="listbox">
			<div class="item active">
				<img src="assets/img/IMG_2017-03-27-172241.jpg" alt="...">
				<div class="carousel-caption">
				</div>
			</div>
			<div class="item">
				<img src="assets/img/223032072_372909_11314578110327828324.jpg" alt="...">
				<div class="carousel-caption">
				</div>
			</div>
		</div>

		<!-- Controls -->
		<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
</div>
<div class="row">
	<h2 class="text-center">Топы</h2>
	<div class="col-xs-12">
		@foreach($top1 as $toper)
		<div class="col-xs-12 col-sm-6 col-md-3 article-block-outer">
			<div class="article-block w100">
				<div class="article-block-inner"><a href="{{url('/advert/'.$toper->advert->id)}}"><!-- <span class="views_count block"><span class="iblock">2738</span></span> --><img src="{{($toper->advert->photos->first()['path'])}}" class="img-responsive" nopin="nopin"  alt="{{$toper->advert->name}}" title="{{$toper->advert->name}}"></a>
					<div class="heading iblock">
						<div><a href="{{url('/services/filter?category='.$toper->advert->advert_categor->id)}}" class="pink f13 bold">{{$toper->advert->advert_categor->name}}</a>
						</div>
						<div class="title"><a href="{{url('/advert/'.$toper->advert->id)}}" class="link">{{$toper->advert->name}}</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>

<div class="row">
	@foreach($cities as $cit)
	<div class="col-xs-6 col-sm-4 cities bgi-{{$cit->name_eng}}">
		<a href="{{url('cities/'.$cit->name_eng)}}">{{$cit->name}}</a>
	</div>
	@endforeach
</div>
<div class="row">
	<h2 class="text-center">Топы 2</h2>
	<div class="col-xs-12">
		@foreach($top2 as $toper2)
		<div class="col-xs-12 col-sm-6 col-md-3 article-block-outer">
			<div class="article-block w100">
				<div class="article-block-inner"><a href="{{url('/advert/'.$toper2->advert->id)}}"><!-- <span class="views_count block"><span class="iblock">2738</span></span> --><img src="{{($toper2->advert->photos->first()['path'])}}" class="img-responsive" nopin="nopin"  alt="{{$toper2->advert->name}}" title="{{$toper2->advert->name}}"></a>
					<div class="heading iblock">
						<div><a href="{{url('/services/filter?category='.$toper2->advert->advert_categor->id)}}" class="pink f13 bold">{{$toper2->advert->advert_categor->name}}</a>
						</div>
						<div class="title"><a href="{{url('/advert/'.$toper2->advert->id)}}" class="link">{{$toper2->advert->name}}</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>
<div class="row info">
	<div class="col-xs-12 col-sm-4">
		<img src="images/info1.png" class="img-responsive img-rounded" alt="Responsive image">
		<h4 class="text-center" style="margin-bottom: 0;">
			Бесплатная
		</h4>
		<h3 class="text-center" style="margin-top: 0;">
			консультация
		</h3>
	</div>
	<div class="col-xs-12 col-sm-4">
		<img src="images/info2.png" class="img-responsive img-rounded" alt="Responsive image">
		<h3 class="text-center" style="margin-bottom: 0; margin-top: 10px">
			Свадьба
		</h3>
		<h4 class="text-center" style="margin-top: 0;margin-left: 66px;">
			под ключ
		</h4>
	</div>
	<div class="col-xs-12 col-sm-4">
		<img src="images/info3.png" class="img-responsive img-rounded" alt="Responsive image">
		<h4 class="text-center" style="margin-bottom: 0;">
			Мы находимся по
		</h4>
		<h3 class="text-center" style="margin-top: 0;">
			<span style="font-size: 18px;">всему</span> Казахстану
		</h3>
	</div>
</div>
<div class="row">
	<h2 class="text-center">Топы 3</h2>
	<div class="col-xs-12">
		@foreach($top3 as $toper3)
		<div class="col-xs-12 col-sm-6 col-md-3 article-block-outer">
			<div class="article-block w100">
				<div class="article-block-inner"><a href="{{url('/advert/'.$toper3->advert->id)}}"><!-- <span class="views_count block"><span class="iblock">2738</span></span> --><img src="{{($toper3->advert->photos->first()['path'])}}" class="img-responsive" nopin="nopin"  alt="{{$toper3->advert->name}}" title="{{$toper3->advert->name}}"></a>
					<div class="heading iblock">
						<div><a href="{{url('/services/filter?category='.$toper3->advert->advert_categor->id)}}" class="pink f13 bold">{{$toper3->advert->advert_categor->name}}</a>
						</div>
						<div class="title"><a href="{{url('/advert/'.$toper3->advert->id)}}" class="link">{{$toper3->advert->name}}</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>
@endsection

