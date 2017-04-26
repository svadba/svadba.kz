@extends('layouts.app')


@section('content')
<div class="row body">
	<div class="col-xs-12 col-sm-10">
		<div class="col-xs-12" style="border-bottom: 6px solid #0abab5;">
			<img src="{{asset($ad->photos->first()['path'])}}" class="img-responsive img-circle img-advert col-xs-12 col-sm-3" alt="Responsive image">
			<h1 >{{$ad->name}}</h1>
			<h4>Рейтинг: {{$ad->rating}}
				<div class='starrr' id='star1'></div>
			</h4>
			<h4>Категория: <a href="{{url('/services/filter/?category='.$ad->advert_categor->id)}}">{{$ad->advert_categor->name}}</a><br></h4>
			<h4>Города:
				@foreach($ad->cits as $adv_cit)
				<a href="{{url('/cities/'.$adv_cit->name_eng)}}">{{$adv_cit->name}}</a>
				@endforeach
			</h4>
		</div>
		<div class="col-xs-12">
			<h4 class="margin-top-always">Информация</h4>
			<p>
				<?php echo $ad->description ; ?>
			</p>
			<br>
			@foreach($ad->photos as $photo)
			<div class="col-xs-12 col-sm-6 col-md-3 col-lg-2" style="padding: 6px;">
				<a href="{{asset($photo->path)}}" data-lightbox="roadtrip">
					<img src="{{asset($photo->path)}}" alt="" class="img-responsive">
				</a>
			</div>
			@endforeach
			@foreach($ad->videos as $video)
			<div class="col-xs-6">
				<iframe class="center-block" src="{{$video->path}}" frameborder="0" allowfullscreen></iframe>
			</div>
			@endforeach
		</div>
	</div>
</div>
@endsection