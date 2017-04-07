@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 style="font-size:20px; margin-bottom:15px;">Подрядчики</h3>
                    <div>
                        <ul style="margin:5px 0px 10px -35px;">
                        </ul>
                    </div>
                    <a href="{{url('contractors/my')}}" class="btn btn-default">
                        <i class="fa fa-star"></i> Мои подрядчики
                    </a>
                    <a href="{{url('contractors/all')}}" class="btn btn-default">
                        <i class="fa fa-list-ul"></i> Все подрядчики
                    </a>
                    <a href="{{url('contractors/add')}}" class="btn btn-default">
                        <i class="fa fa-plus"></i> Добавить подрядчика
                    </a>
                </div>
                
                <div class="panel-body">
                <!-- Отображение ошибок проверки ввода -->
                @include('common.errors')

                <!-- Форма новой задачи -->
                <form style="max-width:300px; margin:20px auto;" action="{{ url('contractors/save') }}" method="POST" class="form-horizontal">
                  {{ csrf_field() }}
                  <!-- Имя задачи -->
                  <div class="form-group">
                    <div class="">
                      <input type="text" name="name" id="name" value="{{Request::old('name')}}" placeholder ="Имя" class="form-control"/>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="">
                      <input type="text" name="surname" value="{{Request::old('surname')}}" id="surname" placeholder ="Фамилия" class="form-control"/>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="">
                      <input type="text" name="middlename" value="{{Request::old('middlename')}}" placeholder ="Отчество" id="middlename" class="form-control"/>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="">
                      <input type="text" name="email" value="{{Request::old('email')}}" placeholder ="Электронная почта" id="middlename" class="form-control"/>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="">
                      <input type="text" name="birthday" value="{{Request::old('birthday')}}" id="birthday" placeholder ="Дата рождения (ДД-ММ-ГГГГ):" class="form-control"/>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="">
                      <input type="text" name="address" value="{{Request::old('address')}}" id="address" placeholder ="Адрес" class="form-control"/>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="">
                      <input type="text" name="phone" id="phone" placeholder ="Телефон" class="form-control"/>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="">
                        <select style="" name="contype" id="contype" class="form-control">
                        @foreach ($contypes as $contype)
                            <option value="{{$contype->id}}">{{$contype->name}}</option>
                        @endforeach            
                        </select>
                    </div>
                  </div>
                  <!-- Кнопка добавления задачи -->
                  <div class="form-group">
                    <div class="">
                      <button type="submit" class="btn btn-primary">
                        <i class=""></i>Добавить
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection

