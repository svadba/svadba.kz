@extends('layouts.app')


@section('content')






	<div class="row col-xs-12 col-sm-10">
		<img src="{{asset($ad->photos->first()['path'])}}" class="img-responsive img-rounded col-xs-12 col-sm-3" alt="Responsive image" width="140" height="140">
		<h1 >{{$ad->name}}</h1>
		<h4>Рейтинг: {{$ad->rating}}
			<div class='starrr' id='star1'></div>
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
		</h4>
		<h4>Категория: <a href="{{url('/services/filter/?category='.$ad->advert_categor->id)}}">{{$ad->advert_categor->name}}</a><br></h4>
		<h4>Города:
			@foreach($ad->cits as $adv_cit)
				<a href="{{url('/cities/'.$adv_cit->name_eng)}}">{{$adv_cit->name}}</a>
			@endforeach</h4>



		<div class="col-xs-12">
			<h4>Информация</h4>
			<p>
				{{$ad->description}}
			</p>
			<div id="carousel-albom-generic" class="carousel slide" data-ride="carousel">
				<!— Indicators —>
				<ol class="carousel-indicators" style="display: none;">
                    <?php $count = 0; $myc = 1; $count_two = 0;?>
					@foreach($ad->photos as $pgj2)
						<?php if( $count == 0 ) {?>
							<?php if($myc == 1) {?>
							<li data-target="#carousel-albom-generic" data-slide-to="{{$count_two}}" class="active"></li>
							<?php } else {?>
							<li data-target="#carousel-albom-generic" data-slide-to="{{$count_two}}" class=""></li> <? } ?>
						<?php $count_two++;
						} ?>
						<?php $count++; $myc++; if($count == 3) {$count = 0;} ?>
					@endforeach
				</ol>

				<!— Wrapper for slides —>
				<div class="carousel-inner" role="listbox">
                    <?php $my_count = 1;  $my_count2 = 1; ?>
					@foreach($ad->photos as $photo2)
                        <?php if($my_count == 1) {?>
						<div class="item <?php if($my_count2 == 1) echo 'active'; ?>">
                            <?php }?>

							<img src="{{asset($photo2->path)}}" alt="" class="col-xs-4 img-thumbnail">

							@if( ($my_count == 3) || ($my_count == count($ad->photos)) || ($my_count2 == count($ad->photos)) )</div> @endif

                        <?php $my_count++; $my_count2++; if($my_count == 4) $my_count = 1; ?>
					@endforeach
				</div>

				<!— Controls —>
				<a class="left carousel-control" href="#carousel-albom-generic" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#carousel-albom-generic" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
			@foreach($ad->videos as $video)
				<div class="col-xs-6">
					<iframe class="center-block" src="{{$video->path}}" frameborder="0" allowfullscreen></iframe>
				</div>
			@endforeach
		</div>
	</div>
	<div class="row col-xs-12 col-sm-2">
		<img src="{{asset('images/info1.png')}}" alt="..." class="col-xs-12 img-thumbnail">
		<div class="col-xs-12 article-block-outer">
			<div class="article-block w100">
				<div class="article-block-inner"><a href=""><!-- <span class="views_count block"><span class="iblock">2738</span></span> --><img src="{{asset('upload/adverts/115/photos/ZOrEuOwfZA1.jpeg')}}" class="img-responsive" nopin="nopin"  alt="Утро невесты в стиле лофт  и ботаник в FloraHub" title="Утро невесты в стиле лофт  и ботаник в FloraHub"></a>
					<div class="heading iblock">
						<div><a href="" class="pink f13 bold">Реальные истории</a>
						</div>
						<div class="title"><a href="" class="link">Утро невесты в стиле лофт  и ботаник в FloraHub</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

