@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Dashboard</h4>
                <a href="{{url('contractor/add')}}" class="btn btn-default">
                    <i class="fa fa-plus"></i> Добавить подрядчика
                </a>
                </div>
                
                <div class="panel-body">
                    <h5>Мною добавленные подрядчики:</h5>
                    <table class="simple-little-table2" cellspacing='0'>
                        <tr>
                            <th>#</th>
                            <th>Имя</th>
                            <th>Фамилия</th>
                            <th>Отчество</th>
                            <th>Дата рождения</th>
                            <th>Телефон</th>
                            <th>Тип</th>
                            <th>Функции</th>
                        </tr>
                    <?php $count = 1;?>
                    @foreach ($user_contractors as $contr)
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td>{{$contr->name}}</td>
                            <td>{{$contr->surname}}</td>
                            <td>{{$contr->middlename}}</td>
                            <td>{{$contr->birthday}}</td>
                            <td>
                            @foreach($contr->phones as $phone)
                                {{$phone->phone}}<br/>
                            @endforeach
                            </td>
                            <td>{{$contr->contype->name}}
                            <?php  $count++; ?>
                            <td>
                                <a class="btn btn-danger" href="{{url('advert/add/'.$contr->id)}}">Добавить заявку</a>
                                <a class="btn btn-danger" href="{{url('contractor/edit/'.$contr->id)}}">Редактировать</a>
                                <a class="btn btn-danger" href="{{url('contractor/delete/'.$contr->id)}}"><i class="fa fa-btn fa-trash"></i>Удалить</a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="8" >
                            <table>
                                <tr>
                                    <th>#</th>
                                    <th>Имя</th>
                                    <th>Описание</th>
                                </tr>
                            @foreach($contr->adverts as $advert)
                                <tr>
                                    <td>{{$advert->name}}</td>
                                    <td>{{$advert->description}}</td>
                                </tr>
                            @endforeach
                            </table>
                            </td>
                        </tr>
                            
                            
                            
                        
                        
                    @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
