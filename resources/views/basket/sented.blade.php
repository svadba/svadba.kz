@extends('layouts.app')


@section('content')
    <div class="body row">
        <script type="text/javascript">
            var date = new Date;
            date.setDate(date.getDate() - 3);
            date = date.toUTCString();
            document.cookie = "basket=false" + "; path=/; expires=" + date;
            $('#count_basket').html('0');
        </script>
        <table class="table table-striped table-hover table-responsive">
            <h2 class="text-center">
                Ваш заказ №{{$br->id}} успешно принят и отправлен нашим менеджерам. С вами свяжутся в ближайшее
                время по
                указанному Вами номеру.
            </h2>
            <tbody>
            @if($request_adverts)
                @foreach($request_adverts as $bask)
                    <tr>
                        <th class="text-center">
                            {{$bask->name}}
                        </th>
                        <th class="text-center">
                            {{$bask->advert_categor->name}}
                        </th>
                    </tr>
                @endforeach
            @endif
			@if($combo)
				<div>
					Имя пакета:{{$combo->name}}
					Цена пакета:{{$combo->name}}
					@if($request_combo_adverts)
						@foreach($request_combo_adverts as $request_combo_advert)
							<div>
								<span>{{$request_combo_advert->name}} </span><span>{{$request_combo_advert->advert_categor->name}}</span>
							</div>
						@endforeach
					@endif
				</div>
			@endif
            </tbody>
        </table>
        <a href="{{secure_url('/')}}" class="big fluid ui animated button" tabindex="0">
            <div class="visible content">Вернуться на главную</div>
            <div class="hidden content">
                <i class="long left arrow icon"></i>
            </div>
        </a>
    </div>

@endsection

