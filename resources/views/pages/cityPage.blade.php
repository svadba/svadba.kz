@extends('layouts.app')


@section('content')
    	<div class="row">
			<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
				<!-- Indicators -->
				<ol class="carousel-indicators">
					<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
					<li data-target="#carousel-example-generic" data-slide-to="1"></li>
					<li data-target="#carousel-example-generic" data-slide-to="2"></li>
				</ol>

				<!-- Wrapper for slides -->
				<div class="carousel-inner" role="listbox">
					<div class="item active">
						<img src="{{asset('assets/img/IMG_2017-03-27-172241.jpg')}}" alt="...">
						<div class="carousel-caption">
						</div>
					</div>
					<div class="item">
						<img src="{{asset('assets/img/223032072_372909_11314578110327828324.jpg"')}} alt="...">
						<div class="carousel-caption">
						</div>
					</div>
				</div>

				<!-- Controls -->
				<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</div>
		<div class="row">
			<h2 class="text-center">Топы 1</h2>
			<div class="col-xs-12">
				@foreach($topsOne as $toper)
					<div class="col-xs-12 col-sm-6 col-md-3 article-block-outer">
						<div class="article-block w100">
							<div class="article-block-inner"><a href="{{url('/advert/'.$toper->advert->id)}}"><!-- <span class="views_count block"><span class="iblock">2738</span></span> --><img src="{{asset($toper->advert->photos->first()['path'])}}" class="img-responsive" nopin="nopin"  alt="{{$toper->advert->name}}" title="{{$toper->advert->name}}"></a>
								<div class="heading iblock">
									<div><a href="{{url('/services/filter?category='.$toper->advert->advert_categor->id)}}" class="pink f13 bold">{{$toper->advert->advert_categor->name}}</a>
									</div>
									<div class="title"><a href="{{url('/advert/'.$toper->advert->id)}}" class="link">{{$toper->advert->name}}</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
		<div class="main_categories col-xs-12">
			<h2 class="text-center">Каталог компаний и специалистов свадебной тематики по основным категориям</h2>
			<div class="main_categories_block flex-combined-row">
				@foreach($categories as $serv)
					<div class="category_block col-cb c137">
						<div class="category_block_wrap">
							<a href="{{url('/services/filter?category='.$serv->id.'&city='.$nowCity->id)}}">
								<div class="image"></div>
								<div class="name">{{$serv->name}}</div>
							</a>
						</div>
					</div>
				@endforeach
			</div>
		</div>
		<div class="row">

			<div class="col-xs-12">
				<h2 class="text-center" style="margin-top: 13px;">Топы 2</h2>
				@foreach($topsTwo as $toper2)
					<div class="col-xs-12 col-sm-6 col-md-3 article-block-outer">
						<div class="article-block w100">
							<div class="article-block-inner"><a href="{{url('/advert/'.$toper2->advert->id)}}"><!-- <span class="views_count block"><span class="iblock">2738</span></span> --><img src="{{asset($toper2->advert->photos->first()['path'])}}" class="img-responsive" nopin="nopin"  alt="{{$toper2->advert->name}}" title="{{$toper2->advert->name}}"></a>
								<div class="heading iblock">
									<div><a href="{{url('/services/filter?category='.$toper2->advert->advert_categor->id)}}" class="pink f13 bold">{{$toper2->advert->advert_categor->name}}</a>
									</div>
									<div class="title"><a href="{{url('/advert/'.$toper2->advert->id)}}" class="link">{{$toper2->advert->name}}</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>

		<div class="row">
			<h2 class="text-center">Топы 3</h2>
			<div class="col-xs-12">
				@foreach($topsThree as $toper3)
					<div class="col-xs-12 col-sm-6 col-md-3 article-block-outer">
						<div class="article-block w100">
							<div class="article-block-inner"><a href="{{url('/advert/'.$toper3->advert->id)}}"><!-- <span class="views_count block"><span class="iblock">2738</span></span> --><img src="{{asset($toper3->advert->photos->first()['path'])}}" class="img-responsive" nopin="nopin"  alt="{{$toper3->advert->name}}" title="{{$toper3->advert->name}}"></a>
								<div class="heading iblock">
									<div><a href="{{url('/services/filter?category='.$toper3->advert->advert_categor->id)}}" class="pink f13 bold">{{$toper3->advert->advert_categor->name}}</a>
									</div>
									<div class="title"><a href="{{url('/advert/'.$toper3->advert->id)}}" class="link">{{$toper3->advert->name}}</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>



@endsection

