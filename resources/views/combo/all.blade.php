@extends('layouts.admin')


@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="">
            <div class="panel panel-default ">
                <div class="panel-heading"><h3 style="font-size:20px; margin-bottom:15px;">Пакеты</h3>
                    <div>
                        <ul style="margin:5px 0px 10px -35px;">
                        </ul>
                    </div>
                    <a href="{{url('admin/combos/all')}}" class="btn btn-default">
                        <i class="fa fa-star"></i> Все пакеты
                    </a>
                    <a href="{{url('admin/combos/add')}}" class="btn btn-default">
                        <i class="fa fa-list-ul"></i> Добавить пакет
                    </a>
                </div>
                <div class="panel-body col-xs-12">
                    <h5>Пакеты:</h5>
                    <table class="table table-striped table-bordered table-hover table-condensed" cellspacing='0'>
                        <tr>
                            <th style="background: #e6e6e6;">№</th>
                            <th style="background: #e6e6e6;">Наименование</th>
                            <th style="background: #e6e6e6;">Наим. транслит</th>
                            <th style="background: #e6e6e6;">Описание</th>
                            <th style="background: #e6e6e6;">Цена</th>
                            <th style="background: #e6e6e6;">Города</th>
                            <th style="background: #e6e6e6;">Функции</th>
                        </tr>

                        <tr>

                        </tr>

                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
