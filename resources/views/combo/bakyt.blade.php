@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="row body">
		<div class="col-xs-12" style="margin-bottom: 30px;">
			<video autoplay="autoplay" loop="loop" poster="" preload="auto">
				<source src="{{secure_asset('videos/bakyt.mov')}}" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"' />
			</video>
		</div>
		<div class="col-xs-12 col-sm-9 text-center">
			<p class="text-center">
				Таусылмайтын мәселе, шаршатқан жалғыздық, бітпейтін күйзеліс, жетпейтін ақша, көңіл толмайтын келбет, артық салмақ, арпалыс өмір, жатып ішер күйеу, аурушаң бала.....STOP!
			</p>
			<p class="text-center">
				Өміріңді өзгерту өз қолыңда!
			</p>
			<p class="text-center">
				Әлем ӘЙЕЛДІҢ алақанында!
			</p>
			<p class="text-center">
				Жуырда ЖАҢА жоба еліміздің 7 бірдей қаласына жол тартпақ.
				Бақыт формуласы, берекелі отбасы, мінсіз келбет, сұлулық сыры, қыздың қырық қулығы мен қылығы, әйел псиxологиясы....Бақытты болуға ештеңе кедергі емес! Ендеше ашық әңгімеге қосылыңыз, сырыңызбен бөлісіңіз! Сондай-ақ, нәзік жандыларды ұтыс билеттері мен арнайы сертификаттар күтеді! Мұнымен тосын сыйлар бітпейді! Өзіңізді жақыннан таныңыз!
			</p>
			<h2 class="text-center">Спикеры Мастер Класса</h2>
			<p><span style="font-weight: bold;">Ләйля Султанқызы</span><span> – телеведущая</span></p>
			<p><span style="font-weight: bold;">Марал Сарбасқызы</span><span> – Психолог</span></p>
			<p><span style="font-weight: bold;">Динара Сембайқызы</span><span> – Стилист</span></p>
			<h1 class="text-center">Мастер класс Бақытты Әйел</h1>
			<table class="table table-striped table-bordered table-hover table-responsive">
				<tbody>
					<tr>
						<th>7 мая (воскресенье)</th>
						<th>МастерКласс (воскресенье)  - Шымкент<p>Место проведение: офис ЦСИ</p></th>
					</tr>
					<tr>
						<th>14 мая (воскресенье)</th>
						<th>Мастер Класс в Караганды<p>Место проведение: офис ЦСИ</p></th>
					</tr>
					<tr>
						<th>21 мая (воскресенье)</th>
						<th>Мастер Класс Алматы<p>Место проведение: офис ЦСИ</p></th>
					</tr>
					<tr>
						<th>4 июня (воскресенье)</th>
						<th>Мастер класс Актау</th>
					</tr>
					<tr>
						<th>25 июня (воскресенье)</th>
						<th>Мастер класс Астана<p>Место проведение: офис ЦСИ</p></th>
					</tr>
					<tr>
						<th>30 июня (пятница)</th>
						<th>Мастер Класс Актобе<p>Место проведение: офис ЦСИ</p></th>
					</tr>
					<tr>
						<th>02 июля (воскресенье)</th>
						<th>Мастер Класс в Атырау<p>Место проведение: офис ЦСИ</p></th>
					</tr>
				</tbody>
			</table>
			<p class="text-center" style="border-bottom: 1px solid #0abab5"><strong>Толық ақпарат:</strong></p>
			<p class="text-center">+7 (776) 125-78-53</p>
			<p class="text-center">+7 (776) 125-78-53</p>
			<p class="text-center">+7 (776) 125-78-53</p>
		</div>
		<div class="col-xs-12 col-sm-3">
			<form action="{{secure_url('basket/sent')}}" method="POST" class="center-block" style="max-width: 290px;">
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

