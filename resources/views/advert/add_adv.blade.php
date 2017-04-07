@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 style="font-size:20px; margin-bottom:15px;">Объявления подрядчиков</h3>
                    <div>
                        <ul style="margin:5px 0px 10px -35px;">
                        </ul>
                    </div>
                    <a href="{{url('adverts/my')}}" class="btn btn-default">
                        <i class="fa fa-star"></i> Мои объявления
                    </a>
                    <a href="{{url('adverts/all')}}" class="btn btn-default">
                        <i class="fa fa-list-ul"></i> Все объявления
                    </a>
                </div>
                
                <div class="panel-body">
                    <!-- Отображение ошибок проверки ввода -->
                    @include('common.errors')
                    <div class="row">
                        <form action="{{url('adverts/save')}}" method="POST" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            <input type="text" hidden="" name="contractor_id" id="contractor_id" value="{{$contr->id}}"/>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Наименование</label>
                                <input type="text" class="form-control" name="name" value="{{Request::old('name')}}" placeholder="Наименование">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Описание</label>
                                <textarea class="form-control" name="description" rows="3">{{Request::old('description')}}</textarea>
                            </div>
                            <div class="form-group">                                
                                <select style="" name="adv_cat" id="advt_cat" class="form-control">
                                    @foreach ($adv_cats as $cat)
                                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                                    @endforeach            
                                </select>
                            </div>
                            <label>Город-Цена</label>
                            <div class="form-group">
                                <div class="input-group cities_prices">
                                    <select class="form-control" name="advert_cits[]">
                                        @foreach($cities as $adv_cit)
                                            <option value="{{$adv_cit->id}}">{{$adv_cit->name}}</option>
                                        @endforeach
                                    </select>                                
                                    <input type="text" class="form-control" name="prices[]" placeholder="Цена">
                                    <span class="input-group-btn"><button type="button" class="btn btn-success btn-add">✚</button></span>
                                </div>
                                <script>
                                    $(document).on('click', '.btn-add', function(event) {

                                        var field = $(this).closest('.form-group');
                                        var field_new = field.clone();

                                        $(this)
                                        .toggleClass('btn-success')
                                        .toggleClass('btn-add')
                                        .html('+');
                                        .toggleClass('btn-danger')
                                        .toggleClass('btn-remove')
                                        .html('✖');
                                    });

                                    $(document).on('click', '.btn-remove', function(event) {
                                        event.preventDefault();
                                        $(this).closest('.form-group').remove();
                                    });
                                </script>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Изображения</label>
                                <input type="file" name="photos[]" multiple/>
                            </div>
                            <div class="form-group">
                                <label>Ссылки на видео</label>
                                <div class="form-group input-group">
                                    <input type="text" name="videos[]" class="form-control">
                                    <span class="input-group-btn"><button type="button" class="btn btn-success btn-add">✚</button></span>
                                </div>
                                <script>
                                    $(document).on('click', '.btn-add', function(event) {
                                        event.preventDefault();

                                        var field = $(this).closest('.form-group');
                                        var field_new = field.clone();

                                        $(this)
                                        .toggleClass('btn-success')
                                        .toggleClass('btn-add')
                                        .toggleClass('btn-danger')
                                        .toggleClass('btn-remove')
                                        .html('✖');

                                        field_new.find('input').val('');
                                        field_new.insertAfter(field);
                                    });

                                    $(document).on('click', '.btn-remove', function(event) {
                                        event.preventDefault();
                                        $(this).closest('.form-group').remove();
                                    });
                                </script>
                                <button type="submit" class="btn btn-primary">Добавить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

