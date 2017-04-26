@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="row body">
		<div class="col-xs-12 col-sm-9">
			<h1 class="text-center">Мастер класс Бақытты Әйел</h1>
			<p style="font-weight: bold;">7 мая (воскресенье)  - МастерКласс (воскресенье)  - Шымкент</p>
			<p>Место проведение: офис ЦСИ</p>
			<p style="font-weight: bold;">14 мая (воскресенье)  - Мастер Класс в Караганды</p>
			<p>Место проведение: офис ЦСИ</p>
			<p style="font-weight: bold;">21 мая (воскресенье) - Мастер Класс Алматы</p>
			<p>Место проведение: офис ЦСИ</p>
			<p style="font-weight: bold;">4 июня (воскресенье)  - Мастер класс Актау</p>
			<p>Место проведение: офис ЦСИ</p>
			<p style="font-weight: bold;">25 июня (воскресенье)  -  Мастер класс Астана</p>
			<p>Место проведение: офис ЦСИ</p>
			<p style="font-weight: bold;">30 июня (пятница) - Мастер Класс Актобе</p>
			<p>Место проведение: офис ЦСИ</p>
			<p style="font-weight: bold;"02 июля (воскресенье)  Мастер Класс в Атырау></p>
			<p>Место проведение: офис ЦСИ</p>
			<h2 class="text-center">Спикеры Мастер Класса</h2>
			<span style="font-weight: bold;">Ләйля Султанқызы</span><span> – телеведущая</span>
			<span style="font-weight: bold;">Марал Сарбасқызы</span><span> – Психолог</span>
			<span style="font-weight: bold;">Динара Сембайқызы</span><span> – Стилист</span>
			<h2 class="text-center">Прайс Мастер класса</h2>
			<p>Стоимость МК – 25.000тыс</p>
			<h2 class="text-center">Прайс отдельных  курсов</h2>
			<p>Ләйля Султанқызы – 20.000тг</p>
			<p>Марал Сарбасқызы – 10.000тг</p>
			<p>Динара Сембайқызы – 7.000тг</p>
			<h2 class="text-center">Тайминг Мастер Класса</h2>
			<p class="text-center">(Сценарий предоставят в понедельник)</p>
			<table class="table table-striped table-bordered table-hover table-responsive">
				<thead>
					<tr>
						<th>Старт дня в 11.00</th>
						<th>Сценарий ждем</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th>11.00-12.00  Динара Сембайқызы</th>
						<th>Тема:</th>
					</tr>
					<tr>
						<th>12.00-13.00  Марал Сарбасқызы</th>
						<th>Тема:</th>
					</tr>
					<tr>
						<th>13.00-14.00 Кофе Брейк</th>
						<th></th>
					</tr>
					<tr>
						<th>14.00-15.00 Ләйля Султанқызы</th>
						<th>Тема:</th>
					</tr>
					<tr>
						<th>15.00-16.00 Вопрос-ответ, фотосессия</th>
						<th>Тема:</th>
					</tr>
					<tr>
						<th>16.00-16.30  Отдых</th>
						<th></th>
					</tr>
					<tr>
						<th>16.30-18.30  Индивдуальные Групповые Курсы</th>
						<th>Тема:</th>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="col-xs-12 col-sm-3">
			<form action="{{url('basket/sent')}}" method="POST" class="center-block" style="max-width: 290px;">
				{{ csrf_field() }}
				<div class="form-group">
					<label for="exampleInputEmail1">Город:</label>
					<select name="city" id="" class="form-control">
						@foreach($cities as $cit)
						<option value="{{$cit->id}}">{{$cit->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Имя:</label>
					<input type="text" class="form-control" name="name" value="{{Request::old('name')}}" placeholder="Имя">
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
</div>
@endsection

