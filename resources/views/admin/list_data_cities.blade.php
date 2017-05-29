@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 style="font-size:20px; margin-bottom:15px;">Списки данных</h3>
                    <div>
                        <ul style="margin:5px 0px 10px -35px;">
                        </ul>
                    </div>
                    <a href="{{secure_url('admin/list_data/cities')}}" class="btn btn-default">
                        <i class="fa fa-list-ul"></i> Города
                    </a>
                    <a href="{{secure_url('admin/list_data/categories')}}" class="btn btn-default">
                        <i class="fa fa-list-ul"></i> Категории
                    </a>
                </div>
                
                <div class="panel-body">
                    <h4>Города</h4>
                    <h5 style="color:red;">Будьте внимательны! Удаление определенного города приведет к удалению все данных зависимых от этого города (т.е. записи: "Город-цена", "Топы города", "Страница города" и т.д.)</h5>
                    <!-- Отображение ошибок проверки ввода -->
                    @include('common.errors')
                    <form style="margin-bottom:20px; border:1px solid gray; padding:10px;" action="{{secure_url('admin/list_data/city/add')}}" method="POST">
                        {{ csrf_field() }}
                        <p>Добавление города</p>
                        <div class="form-group">
                            <input style="max-width:300px; padding:5px;" name="name" placeholder="Наименование на русском">
                            <input style="max-width:300px; padding:5px;"  name="name_eng" placeholder="Наименование транслитом">
                            <button type="submit" class="btn btn-primary">Добавить</button>
                        </div>
                    </form>
                    <table class="table table-striped table-bordered table-hover table-condensed" cellspacing='0'>
                        <tr>
                            <th style="background: #d0d0d0;">#</th>
                            <th style="background: #d0d0d0;">Название города</th>
                            <th style="background: #d0d0d0;">Транслит города</th>
                            <th style="background: #d0d0d0;">Функции</th>
                        </tr>
                    <?php $count = 1;?>
                    @foreach ($cities as $cit)
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td>{{$cit->name}}</td>
                            <td>{{$cit->name_eng}}</td>
                            <td style="width: 172px; text-align: right;">
                                <a class="btn btn-warning" title="Редактировать город" href="{{secure_url('admin/list_data/city/edit/'.$cit->id)}}"><i class="fa fa-pencil"></i></a>
                                <a class="btn btn-danger" title="Удалить город" href="{{secure_url('admin/list_data/city/delete_test/'.$cit->id)}}"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                    <?php  $count++; ?>
                    @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
