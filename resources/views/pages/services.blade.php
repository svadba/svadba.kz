@extends('layouts.app')


@section('content')
	<div class="main_categories col-xs-12">
		<h2 class="text-center">Каталог компаний и специалистов свадебной тематики по основным категориям</h2>
		<div class="main_categories_block flex-combined-row">
		@foreach($services as $serv)
			<div class="category_block col-cb c137">
				<div class="category_block_wrap">
					<a href="{{url('/services/filter?category='.$serv->id)}}">
						<div class="image"></div>
						<div class="name">{{$serv->name}}</div>
					</a>
				</div>
			</div>
		@endforeach
		</div>
	</div>
@endsection

