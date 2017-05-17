@extends('layouts.app')


@section('content')

<!-- Отображение ошибок проверки ввода -->
@include('common.errors')
<div class="row body">
	<div class="col-xs-12 col-sm-9 padding-0-always ui link cards" style="background: rgba(111, 151, 213, .6);">
		@if($combo && $combo_cit && $combo_cook)
		<input type="hidden" name="combo" value="{{$combo->id}}">
		<input type="hidden" name="combo_cit" value="{{$combo_cit->id}}">

		<div class="col-xs-12 margin-top-always">
			<div class="col-xs-12 col-sm-4 padding-0-always" style="margin-left: 33%;">
				<div class="col-xs-3 padding-0-always">
					<img src="{{asset($combo->photo_path)}}" alt="" class="img-responsive">
				</div>
				<div class="col-xs-9 padding-0-always text-center">
					<h2 style="color: #191e23; margin-top: 6px; margin-bottom: 6px;">{{$combo->name}}</h2>
					<p style="color: #191e23; font-size: 18px;">{{$combo->price}}ТГ</p>
				</div>
			</div>
		</div>
		<div class="col-xs-12 padding-0-always tab-content">
			@foreach($combo_cit->combo_categors as $combo_categor2)
			@if(array_key_exists($combo_categor2->id, $combo_cook))
			@foreach($combo_categor2->adverts as $advert)
			@if( $combo_cook[$combo_categor2->id] == $advert->id )
			<div class="col-xs-12 baseAdvDiv-{{$combo_categor2->id}}" id="baseAd-{{$advert->id}}" style="width: 20%;">
				<div class="card">
					<div class="blurring dimmable image">
						<div class="ui dimmer">
							<div class="content">
								<div class="center">
									<div style="max-height: 72.5px; overflow: hidden; text-overflow: ellipsis;">
										<?php echo $advert->description; ?>
									</div>
									@foreach($advert->photos as $photo)
									<div class="col-xs-3 photo-advert" style="background-image: url({{asset($photo->path)}});"></div>
									@endforeach
								</div>
							</div>
						</div>
						<img src="{{asset($advert->photo_main())}}" alt="">
					</div>
					<div class="content">
						<div class="header text-center" style="font-size: 12px;">{{$advert->name}} {{$combo_categor2->advert_categor->name}}</div>
					</div>
					<div class="extra content">
						<div class="ui two buttons">
							<a id="change-{{$advert->id}}" href="#modal{{$combo_categor2->id}}" data-toggle="modal" class="ui basic teal button change_adv">Изменить</a>
						</div>
					</div>
				</div>
			</div>
			@endif
			@endforeach
			@endif
			@endforeach
			@foreach($combo_cit->combo_categors as $combo_categor3)
			<div id="modal{{$combo_categor3->id}}" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<!-- Заголовок модального окна -->
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title">Изменение категории: {{$combo_categor2->advert_categor->name}}</h4>
						</div>
						<!-- Основное содержимое модального окна -->
						<div class="modal-body">
							<div class="geted_cities">
								@foreach($combo_categor3->adverts as $advert)
								<div id="minadv-{{$advert->id}}" class="col-xs-12 col-sm-4 minadvdiv-{{$combo_categor3->id}}" style="padding-right: 0;">
									<div class="card">
										<div class="blurring dimmable image">
											<img class="minadvimg-{{$advert->id}}" src="{{asset($advert->photo_main())}}" alt="">
										</div>
										<div class="content">
											<div class="header text-center">{{$advert->name}}</div>
										</div>
										<div class="extra content">
											<span style="float: left;"><i class="unhide icon"></i> {{$advert->views}} </span>
											<span style="float: right;"><i class="star icon"></i> {{$advert->rating}} </span>
										</div>
										<div class="extra content">
											<div class="ui two buttons">
												<a href="#" id="take-{{$advert->id}}-{{$combo_categor3->id}}" class=" ui basic teal button take_adv">Выбрать</a>
											</div>
										</div>
									</div>
								</div>
								@endforeach
							</div>
						</div>
						<!-- Футер модального окна -->
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
							<button type="button" id="save-{{$combo_categor3->id}}" data-dismiss="modal" class="btn ui primary button save_adv">Сохранить изменения</button>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
		@else
		<h1>nety combo</h1>
		@endif
	</div>
	<form action="{{url('basket/sent')}}" method="POST" class="center-block col-xs-12 col-sm-3" style="max-width: 290px;">
		{{ csrf_field() }}
		<div class="form-group">
			<label for="exampleInputEmail1">Имя:</label>
			<input type="text" class="form-control" name="name" value="{{Request::old('name')}}" placeholder="Имя">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Город:</label>
			<select name="city" id="" class="form-control">
				@foreach($cities as $cit)
				<option value="{{$cit->id}}">{{$cit->name}}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Телефон:</label>
			<input type="text" class="form-control" name="phone" value="{{Request::old('phone')}}" placeholder="Телефон">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Электронный адрес:</label>
			<input type="text" class="form-control" name="email" value="{{Request::old('email')}}" placeholder="Электронный адрес">
		</div>
		<button type="submit" class="btn btn-default">Отправить</button>
	</form>
	<div class="col-xs-12 col-sm-9 padding-0-always ui link cards">
		@if($basket_adv)
		@foreach($basket_adv as $bask)
		<div id="bask_{{$bask->id}}" class="col-xs-12 col-sm-4 padding-0-always">
			<div class="card">
				<div class="image">
					@if($bask->photos->first())
					<img src="{{asset('upload/adverts/thumbs/'.$bask->photos->first()['name'].'.'.$bask->photos->first()['ext'])}}" alt="{{$bask->name}}" title="{{$bask->name}}">
					@else
					<img src="{{asset('images/no-avatar.png')}}" alt="{{$bask->name}}" title="{{$bask->name}}">
					@endif
				</div>
				<div class="content">
					<a href="{{url('advert/'.$bask->id)}}" class="header">{{$bask->name}}</a>
					<div class="meta">
						<a href="{{url('services/filter?category='.$bask->advert_categor_id)}}" class="date">{{$bask->advert_categor->name}}</a>
					</div>
				</div>
				<div class="extra content">
					<div id='{{$bask->id}}' class="ui basic red button del_from_bask">Убрать</div>
				</div>
			</div>
		</div>
		@endforeach
		@endif
	</div>
</div>
	<script type="text/javascript">



	</script>
@endsection

