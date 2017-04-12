@extends('layouts.app')


@section('content')
	<div class="row">
		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
			<!-- Indicators -->
			<ol class="carousel-indicators">
                <?php $count = 0; ?>
				@foreach($ad->photos as $gj)
					<li data-target="#carousel-example-generic" data-slide-to="{{$count}}" @if($count == 0) class="active" @endif></li>
                    <?php $count++; ?>
				@endforeach
			</ol>

			<!-- Wrapper for slides -->
			<div class="carousel-inner" role="listbox">
				<?php $count = 0; ?>
				@foreach($ad->photos as $photo_slide)
				<div class="item @if($count == 0) active @endif">
					<img src="{{asset($photo_slide->path)}}" alt="...">
					<div class="carousel-caption">
					</div>
				</div>
				<?php $count++; ?>
				@endforeach
			</div>

			<!-- Controls -->
			<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev" style="width: 6%">
				<span class="glyphicon glyphicon-menu-left first" aria-hidden="true"></span>
				<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next" style="width: 6%">
				<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
				<span class="glyphicon glyphicon-menu-right last" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</div>
	<div class="row head">
		<div class="col-sm-7 col-xs-12">
			<div class="col-xs-12">
				<ol class="breadcrumb">
					<li><a href="{{url('/')}}">Главная</a></li>
					<li class="active"><a href="{{url('/services/')}}">Все Услуги</a></li>
					<li class="active"><a href="{{url('/services/filter?category='.$ad->advert_categor->id)}}">{{$ad->advert_categor->name}}</a></li>
				</ol>
				<h1>
					{{$ad->name}}
				</h1>
				<h3>
					@foreach($ad->cits as $adv_cit)
					<a href="{{url('/cities/'.$adv_cit->name_eng)}}">{{$adv_cit->name}}</a>
					@endforeach
				</h3>
				<h3>
					Рейтинг
					<div class='starrr' id='star1'>{{$ad->rating}}</div>
					<div>&nbsp;
						<span class='your-choice-was' style='display: none;'>
								Your rating was <span class='choice'></span>.
						</span>
					</div>
					<script>
                        $('#star1').starrr({
                            change: function(e, value){
                                if (value) {
                                    $('.your-choice-was').show();
                                    $('.choice').text(value);
                                } else {
                                    $('.your-choice-was').hide();
                                }
                            }
                        });
					</script>
				</h3>
			</div>
		</div>
		<div class="col-sm-4 col-xs-12">
			<div class="col-xs-12">
				{{--<h3 style="text-transform: uppercase; color: #fff">--}}
					{{--Гонорар:--}}
				{{--</h3>--}}
				<img src="{{url('/specialists/'.$ad->advert_categor->name_eng)}}" class="img-responsive img-circle img-thumbnail avatars" alt="Responsive image">
				<span style="position: absolute;bottom: 15px;color: #fff; font-size: 18px;">{{$ad->advert_categor->name}}</span>
			</div>
			<div class="col-xs-12">
				<h3 style="color: #fff; position: absolute; bottom: 0;margin-bottom: 6px;">
					Медиа
				</h3>
				<span style="font-size: 14px;right: 0;position: absolute;bottom: 0;">
						<a href="#" style="color: #fff">
							Просмотреть все
						</a>
				</span>
			</div>
			<div class="col-xs-12" style="padding: 0;">
				<div id="carousel-media-generic" class="carousel slide" data-ride="carousel">
					<!-- Indicators -->
					<ol class="carousel-indicators" style="display: none;">
                        <?php $count = 0; ?>
						@foreach($ad->photos as $pgj2)
							<li data-target="#carousel-example-generic" data-slide-to="{{$count}}" @if($count == 0) class="active" @endif></li>
                            <?php $count++; ?>
						@endforeach
					</ol>

					<!-- Wrapper for slides -->
					<div class="carousel-inner" role="listbox">
						<?php $my_count = 0;  $my_count2 = 0; ?>
						@foreach($ad->photos as $photo2)
							<?php if($my_count == 0) {?>
								<div class="item <?php if($my_count2 == 0) echo 'activ'; ?>">
							<?php }?>

						<div class="col-xs-4"><img src="{{asset($photo2->path)}}" alt="" class="img-responsive"></div>

						@if($my_count == 4)</div> @endif

						<?php $my_count++; $my_count2++; if($my_count == 5) $my_count = 0; ?>

						@endforeach
					</div>

					<!-- Controls -->
					<a class="left carousel-control" href="#carousel-media-generic" role="button" data-slide="prev" style="left: -15px; width: 10%;background: #a9e7e5;">
						<span class="glyphicon glyphicon-menu-left first" aria-hidden="true" style="left: 6px;"></span>
						<span class="glyphicon glyphicon-menu-left" aria-hidden="true" style="position: absolute;left:0;"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="right carousel-control" href="#carousel-media-generic" role="button" data-slide="next" style="right: -15px; width: 10%;background: #a9e7e5;">
						<span class="glyphicon glyphicon-menu-right" aria-hidden="true" style="position: absolute;right:0;"></span>
						<span class="glyphicon glyphicon-menu-right last" aria-hidden="true" style="right: 6px;"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-7" style="padding-top: 0;">
		<h3 class="text-center">
			Описание
		</h3>
		<div class="col-xs-12 col-sm-10">
			<div class="col-xs-12">
				{{$ad->description}}
			</div>
		</div>
	</div>
@endsection

