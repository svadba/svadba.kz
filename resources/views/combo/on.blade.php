@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="row body">
		<div>
			<!-- Nav tabs -->
			<ul class="col-xs-12 col-sm-3 text-center nav nav-tabs" role="tablist" style="margin-top: 120px;">
				<li role="presentation" class="col-xs-12 margin-top-always active"><a href="#1" aria-controls="home" role="tab" data-toggle="tab">1</a></li>
				<li role="presentation" class="col-xs-12"><a href="#2" aria-controls="profile" role="tab" data-toggle="tab">2</a></li>
				<li role="presentation" class="col-xs-12"><a href="#3" aria-controls="messages" role="tab" data-toggle="tab">3</a></li>
				<li role="presentation" class="col-xs-12 margin-bottom-always"><a href="#4" aria-controls="settings" role="tab" data-toggle="tab">4</a></li>
				<a href="#" class="btn btn-default margin-bottom-always">Оформить заявку</a>
			</ul>

			<!-- Tab panes -->
			<div class="col-xs-12 col-sm-9 tab-content">
				<div role="tabpanel" class="tab-pane active" id="1">
					<div class="col-xs-12 col-sm-4">
						<img src="{{secure_asset('images/icons/city.png')}}" alt="">
					</div>
					<div class="col-xs-12 col-sm-4">
						<img src="{{secure_asset('images/icons/city.png')}}" alt="">
					</div>
					<div class="col-xs-12 col-sm-4">
						<img src="{{secure_asset('images/icons/city.png')}}" alt="">
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="2">
					<div class="col-xs-12 col-sm-4">
						<img src="{{secure_asset('images/icons/marry.png')}}" alt="">
					</div>
					<div class="col-xs-12 col-sm-4">
						<img src="{{secure_asset('images/icons/marry.png')}}" alt="">
					</div>
					<div class="col-xs-12 col-sm-4">
						<img src="{{secure_asset('images/icons/marry.png')}}" alt="">
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="3">
					<div class="col-xs-12 col-sm-4">
						<img src="{{secure_asset('images/icons/city.png')}}" alt="">
					</div>
					<div class="col-xs-12 col-sm-4">
						<img src="{{secure_asset('images/icons/city.png')}}" alt="">
					</div>
					<div class="col-xs-12 col-sm-4">
						<img src="{{secure_asset('images/icons/city.png')}}" alt="">
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="4">
					<div class="col-xs-12 col-sm-4">
						<img src="{{secure_asset('images/icons/marry.png')}}" alt="">
					</div>
					<div class="col-xs-12 col-sm-4">
						<img src="{{secure_asset('images/icons/marry.png')}}" alt="">
					</div>
					<div class="col-xs-12 col-sm-4">
						<img src="{{secure_asset('images/icons/marry.png')}}" alt="">
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
@endsection

