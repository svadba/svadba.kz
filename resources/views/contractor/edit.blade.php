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
          <a href="{{url('admin/contractors/my')}}" class="btn btn-default">
            <i class="fa fa-star"></i> Мои подрядчики
          </a>
          <a href="{{url('admin/contractors/all')}}" class="btn btn-default">
            <i class="fa fa-list-ul"></i> Все подрядчики
          </a>
          <a href="{{url('admin/contractors/add')}}" class="btn btn-default">
            <i class="fa fa-plus"></i> Добавить подрядчика
          </a>
        </div>

        <div class="panel-body">
          <!-- Отображение ошибок проверки ввода -->
          @include('common.errors')

          <!-- Форма новой задачи -->
          <form style="max-width:300px; margin:20px auto;" action="{{ url('admin/contractors/edit_go') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <input type="hidden" name="contractor_id" value="{{$contractor->id}}" />
            <!-- Имя задачи -->
            <div class="form-group">
              <div class="">
                  @if(Request::old('name'))
                    <input type="text" name="name" placeholder ="Имя" class="form-control" value="{{Request::old('name')}}"/>
                  @else
                    <input type="text" name="name" placeholder ="Имя" class="form-control" value="{{$contractor->name}}"/>
                  @endif
              </div>
            </div>
            <div class="form-group">
              <div class="">
                  @if(Request::old('surname'))
                    <input type="text" name="surname" id="surname" placeholder ="Фамилия" class="form-control" value="{{Request::old('surname')}}"/>
                  @else
                    <input type="text" name="surname" id="surname" placeholder ="Фамилия" class="form-control" value="{{$contractor->surname}}"/>
                  @endif
              </div>
            </div>
            <div class="form-group">
              <div class="">
                  @if(Request::old('middlename'))
                    <input type="text" name="middlename" placeholder ="Отчество" class="form-control" value="{{Request::old('middlename')}}"/>
                  @else
                    <input type="text" name="middlename" placeholder ="Отчество" class="form-control" value="{{$contractor->middlename}}"/>
                  @endif
              </div>
            </div>
            <div class="form-group">
              <div class="">
                  @if(Request::old('email'))
                    <input type="text" name="email" placeholder ="Электронная почта" id="middlename" class="form-control" value="{{Request::old('email')}}"/>
                  @else
                    <input type="text" name="email" placeholder ="Электронная почта" id="middlename" class="form-control" value="{{$contractor->email}}"/>
                  @endif
              </div>
            </div>
            <div class="form-group">
              <div class="">
                  @if(Request::old('birthday'))
                    <input type="text" name="birthday" id="birthday" placeholder ="Дата рождения (ДД-ММ-ГГГГ):" class="form-control" value="{{Request::old('birthday')}}"/>
                  @else
                    <input type="text" name="birthday" id="birthday" placeholder ="Дата рождения (ДД-ММ-ГГГГ):" class="form-control" value="{{$contractor->birthday}}"/>
                  @endif
              </div>
            </div>
            <div class="form-group">
              <div class="">
                @if(Request::old('address'))
                    <input type="text" name="address" id="address" placeholder ="Адрес" class="form-control" value="{{Request::old('address')}}"/>
                @else
                    <input type="text" name="address" id="address" placeholder ="Адрес" class="form-control" value="{{$contractor->address}}"/>
                @endif
 
              </div>
            </div>
            <div class="form-group">
              @foreach($contractor->phones as $phone)
              <div class="col-xs-12">
                <div class="tel">
                  <abbr title="Телефон">Т:</abbr><tel>{{$phone->phone}}</tel>
                  <a type="button" class="btn btn-danger btn-xs" href="{{url('admin/phones/delete/'.$phone->id)}}">&#10060;</a>
                </div>
              </div>
              <br/>
            @endforeach
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
            </div>
            <div class="form-group">
              <div class="">
                <select style="" name="contype" id="contype" class="form-control">
                  @if(Request::old('contype'))
                     @foreach ($contypes as $contype)
                        @if($contype->id == Request::old('contype'))
                            <option selected value="{{$contype->id}}">{{$contype->name}}</option>
                        @else
                            <option value="{{$contype->id}}">{{$contype->name}}</option>
                        @endif
                    @endforeach   
                  @else
                    @foreach ($contypes as $contype)
                        @if($contype->id == $contractor->contype_id)
                            <option selected value="{{$contype->id}}">{{$contype->name}}</option>
                        @else
                            <option value="{{$contype->id}}">{{$contype->name}}</option>
                        @endif
                    @endforeach 
                  @endif
                             
                </select>
              </div>
            </div>
            <!-- Кнопка добавления задачи -->
            <div class="form-group">
              <div class="">
                <button type="submit" class="btn btn-primary">
                  <i class=""></i>Сохранить
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

