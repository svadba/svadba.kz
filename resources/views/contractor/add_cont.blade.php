@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="">
      <div class="panel panel-default">
        <div class="panel-heading"><h3 style="font-size:20px; margin-bottom:15px;">Подрядчики</h3>
          <div>
            <ul style="margin:5px 0px 10px -35px;">
            </ul>
          </div>
          <a href="{{secure_url('admin/contractors/my')}}" class="btn btn-default">
            <i class="fa fa-star"></i> Мои подрядчики
          </a>
          <a href="{{secure_url('admin/contractors/all')}}" class="btn btn-default">
            <i class="fa fa-list-ul"></i> Все подрядчики
          </a>
          <a href="{{secure_url('admin/contractors/add')}}" class="btn btn-default">
            <i class="fa fa-plus"></i> Добавить подрядчика
          </a>
        </div>

        <div class="panel-body">
          <!-- Отображение ошибок проверки ввода -->
          @include('common.errors')

          <!-- Форма новой задачи -->
          <form style="max-width:300px; margin:20px auto;" action="{{ secure_url('admin/contractors/save') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <!-- Имя задачи -->
            <div class="form-group">
              <div class="">
                <input type="text" name="name" id="name" value="{{Request::old('name')}}" placeholder ="Имя" class="form-control"/>
              </div>
            </div>
            <div class="form-group">
              <div class="">
                <input type="text" name="surname" id="surname" value="{{Request::old('surname')}}" placeholder ="Фамилия" class="form-control"/>
              </div>
            </div>
            <div class="form-group">
              <div class="">
                <input type="text" name="middlename" placeholder ="Отчество" value="{{Request::old('middlename')}}" id="middlename" class="form-control"/>
              </div>
            </div>
            <div class="form-group">
              <div class="">
                <input type="text" name="email" value="{{Request::old('email')}}" placeholder ="Электронная почта" id="middlename" class="form-control"/>
              </div>
            </div>
            <div class="form-group">
              <div class="">
                <input type="text" name="birthday" id="birthday" value="{{Request::old('birthday')}}" placeholder ="Дата рождения (ДД-ММ-ГГГГ):" class="form-control"/>
              </div>
            </div>
            <div class="form-group">
              <div class="">
                <input type="text" name="address" id="address" value="{{Request::old('address')}}" placeholder ="Адрес" class="form-control"/>
              </div>
            </div>
            @if(Request::old('phones'))
            @foreach(Request::old('phones') as  $phone)
            @if($phone)
            <div class="form-group">
              <div class="form-group input-group">
                <input type="text" name="phones[]" value="{{$phone}}" id="phone" placeholder ="Телефон" class="form-control"/>
                <span class="input-group-btn"><button type="button" class="btn btn-danger btn-remove">&#10060;</button></span>
              </div>
            </div>  
            @endif
            @endforeach
            @endif
            <div class="form-group">
              <div class="form-group input-group">
                <input type="text" name="phones[]" id="phone" placeholder ="Телефон" class="form-control"/>
                <span class="input-group-btn"><button type="button" class="btn btn-success btn-add">&#10010;</button></span>
              </div>
            </div>
            <script>
              $(document).on('click', '.btn-add', function(event) {
                  event.preventDefault();

                  var field = $(this).closest('.form-group');
                  var field_new = field.clone();

                  field_new.find('.btn').removeClass('btn-success')
                  field_new.find('.btn').toggleClass('btn-danger')
                  field_new.find('.btn').removeClass('btn-add')
                  field_new.find('.btn').toggleClass('btn-remove')
                  field_new.find('.btn').html('&#10060;')
                  field_new.find('input').val('')
                  field_new.insertAfter(field)
                });

                $(document).on('click', '.btn-remove', function(event) {
                  event.preventDefault();
                  $(this).closest('.form-group').remove();
                });
            </script>
            <div class="form-group">
              <div class="">
                <select style="" name="contype" id="contype" class="form-control">
                  @foreach ($contypes as $contype)
                    @if(Request::old('contype') == $contype->id)
                        <option selected value="{{$contype->id}}">{{$contype->name}}</option>
                    @else
                        <option value="{{$contype->id}}">{{$contype->name}}</option>
                    @endif
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

