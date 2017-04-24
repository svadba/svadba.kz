@extends('layouts.app')


@section('content')
<div class="row body">
	<div class="col-xs-12 padding-bottom">
		<div class="col-xs-12 col-sm-9 xs-padding-right-left-hidden">
			<div class="col-xs-12 padding">
				<div class="col-xs-12 col-sm-3">
					<h2 class="text-center">Ваш город:</h2>
				</div>
				<form method="GET" action="{{url('/city/by_id')}}">
					<div class="col-xs-12 col-sm-9 input-group">
						{{csrf_field()}}
						<select name="city" id="cities" class="form-control">
							@foreach($cities as $cit)
							<option value="{{$cit->id}}">{{$cit->name}}</option>
							@endforeach
							<option value="16">Артисты Казахстана</option>
							<option value="17">Артисты России</option>
							<option value="18">Артисты Мора</option>
						</select>
						<span class="input-group-btn">
							<button class="btn btn-default" type="submit">Выбрать!</button>
						</span>
					</div>
				</form>
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
			<a href="#cities-block" class="link step col-xs-12 col-sm-3 xs-padding-right-left-hidden">
				<div class="content">
					<img src="{{asset('images/icons/marry.png')}}" alt="">
					<div class="title">Собрать пакет</div>
					<div class="description">Соберите пакет свадебных услуг</div>
				</div>
			</a>
			<a href="#cities-block" class="link step col-xs-12 col-sm-3 xs-padding-right-left-hidden">
				<div class="content">
					<img src="{{asset('images/icons/call.png')}}" alt="">
					<div class="title">Оставить заявку</div>
					<div class="description">После добавления всех услуг отправьте нам заявку</div>
				</div>
			</a>
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
		<div class="col-xs-12 col-sm-2 text-center">
			<a href="{{url('cities/Artists_of_Kazakhstan')}}" class="center-block ui small image">
				<img src="{{asset('images/icons/Artists_of_Kazakhstan.png')}}">
			</a>
		</div>
		<div class="col-xs-12 col-sm-2 text-center">
			<a href="{{url('cities/Artists_of_Russia')}}" class="center-block ui small image">
				<img src="{{asset('images/icons/Artists_of_Russia.png')}}">
			</a>
		</div>
		<div class="col-xs-12 col-sm-2 text-center">
			<a href="{{url('cities/Artists_of_the_World')}}" class="center-block ui small image">
				<img src="{{asset('images/icons/Artists_of_the_World.png')}}">
			</a>
		</div>
	</div>
</div>
@endsection

