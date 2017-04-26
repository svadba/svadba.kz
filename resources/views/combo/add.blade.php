@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 style="font-size:20px; margin-bottom:15px;">Пакеты</h3>
                    <div>
                        <ul style="margin:5px 0px 10px -35px;">
                        </ul>
                    </div>
                    <a href="{{url('admin/combos/all')}}" class="btn btn-default ">
                        <i class="fa fa-star"></i> Все пакеты
                    </a>
                    <a href="{{url('admin/combos/add')}}" class="btn btn-default">
                        <i class="fa fa-list-ul"></i> Добавить пакет
                    </a>

                </div>
                
                <div class="panel-body">
                    <!-- Отображение ошибок проверки ввода -->
                    @include('common.errors')
                    <div class="row">
                        <form action="{{url('admin/combos/add')}}" method="post">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Наименование</label>
                                <input type="text" class="form-control" name="name" value="" placeholder="Наименование">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Описание</label>
                                <input type="text" class="form-control" name="description" value="" placeholder="Описание">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Цена</label>
                                <input type="text" class="form-control" name="price" value="" placeholder="Цена">
                            </div>
                            <button type="submit" class="btn btn-primary">Добавить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

