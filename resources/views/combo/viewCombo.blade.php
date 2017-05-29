@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="row body">
		<input type="hidden" name="combo" value="{{$combo->id}}">
		<input type="hidden" name="combo_cit" value="{{$combo_cit->id}}">
		<div class="col-xs-12 col-sm-3">
			<div class="col-xs-12 padding-0-always" style="background: rgba(111, 151, 213, .6); border-radius: 54px 6px 0 54px;">
				<div class="col-xs-3 padding-0-always">
					<img src="{{secure_asset($combo->photo_path)}}" alt="" class="img-responsive">
				</div>
				<div class="col-xs-9 padding-0-always text-center">
					<h2 style="color: #191e23; margin-top: 6px; margin-bottom: 6px;">{{$combo->name}}</h2>
					<p style="color: #191e23; font-size: 18px;">{{$combo->price}}ТГ</p>
				</div>
			</div>
			<ul class="col-xs-12 margin-top-always nav nav-tabs text-center" role="tablist">
				<?php $stage = 'margin-top-always active';?>
				@foreach($combo_cit->combo_categors as $combo_categor)
				<li role="presentation" class="col-xs-12 {{$stage}}"><a href="#{{$combo_categor->id}}" aria-controls="{{$combo_categor->id}}" role="tab" data-toggle="tab">{{$combo_categor->advert_categor->name}}</a></li>
				<?php $stage = '';?>
				@endforeach
				<a href="#" class="btn btn-default margin-top-always margin-bottom-always setCombo">Оформить заявку</a>
			</ul>
		</div>
		<div class="col-xs-12 col-sm-9 padding-0-always tab-content">
			<?php $stage = 'active';?>
			@foreach($combo_cit->combo_categors as $combo_categor2)
			<div role="tabpanel" class="tab-pane {{$stage}}" id="{{$combo_categor2->id}}">
				<h3 class="margin-top-always margin-bottom-always text-center">Имя категории: {{$combo_categor2->advert_categor->name}}</h3>
				<div class="col-xs-12 padding-0-always ui special cards">
					<?php $checked = 'checked'; ?>
					@foreach($combo_categor2->adverts as $advert)
					<div id="baseAd-{{$advert->id}}" class="col-xs-12 col-sm-4 padding-0-always baseAdvDiv-{{$combo_categor2->id}}">
						<div class="card">
							<div class="blurring dimmable image">
								<div class="ui dimmer">
									<div class="content">
										<div class="center">
											<div style="max-height: 72.5px; overflow: hidden; text-overflow: ellipsis;">
											{{$advert->description}}
											</div>
											@foreach($advert->photos as $photo)
											<div class="col-xs-3 photo-advert" style="background-image: url({{secure_asset($photo->path)}});"></div>
											@endforeach
										</div>
									</div>
								</div>
								<img src="{{secure_asset($advert->photo_main())}}" alt="">
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
									<span id="dekBut-{{$combo_categor2->id}}-{{$advert->id}}" class="ui basic green button dekBut"><input id="{{$advert->id}}" class="radioAdv radio-{{$combo_categor2->id}}" {{$checked}} name="{{$combo_categor2->id}}" type="radio" value="{{$advert->id}}" style="width: 100%;height: 100%;position: absolute;visibility: hidden;margin: 0;left: 0;top: 0;">Выбрать</span>
									<a href="" class="ui basic teal button">Подробнее</a>
								</div>
							</div>
						</div>
					</div>
                    <?php $checked = ''; ?>
					<?php $stage = '';?>
					@endforeach
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>
@endsection

