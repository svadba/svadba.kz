@extends('layouts.app')


@section('content')

	<script type="text/javascript">
        var date = new Date;
        date.setDate(date.getDate() - 3);
        date = date.toUTCString();
        document.cookie = "basket=false" + "; path=/; expires=" + date;
        $('#count_basket').html('0');
	</script>
	<div style="margin-top:200px;"></div>
	<h2>Ваш заказ №{{$br->id}} успешно принят и отправлен нашим менеджерам. С вами свяжутся в близжайщее время по указанному Вами номеру.</h2>
	<div>
		@if($request_adverts)
			@foreach($request_adverts as $bask)
				<div><span>{{$bask->name}} </span><span>{{$bask->advert_categor->name}}</span></div>
			@endforeach
		@endif
	</div>
	<a href="{{url('/')}}">Вернуться на главную</a>

@endsection

