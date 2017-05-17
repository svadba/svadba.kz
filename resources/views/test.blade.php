@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>

                <div class="panel-body">
                    count {{$c1}} <br>
                    combo_cit_categors {{$c2}}<br>
                    combo_cits {{$c3}}<br>
                    combo {{$c4}}<br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
