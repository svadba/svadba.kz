@extends('layouts.app')


@section('content')

<!-- Отображение ошибок проверки ввода -->
@include('common.errors')
<div class="row body">
	<div class="col-xs-12 col-sm-9 padding-0-always ui link cards">
		@if($basket_adv)
		@foreach($basket_adv as $bask)
		<div id="bask_{{$bask->id}}" class="col-xs-12 col-md-6 col-lg-4 padding-0-always">
			<div class="card">
				<div class="image">
					<img src="{{asset($bask->photos->first()['path'])}}"/>
				</div>
				<div class="content">
					<a class="header">{{$bask->name}}</a>
					<div class="meta">
						<a class="date">{{$bask->advert_categor->name}}</a>
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
	<div class="col-xs-12 col-sm-3">
		<form action="{{url('basket/sent')}}" method="POST" class="center-block" style="max-width: 290px;">
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
	</div>
</div>
@endsection

