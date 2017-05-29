@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 style="font-size:20px; margin-bottom:15px;">Объявления подрядчиков</h3>
                    <div>
                        <ul style="margin:5px 0px 10px -35px;">
                        </ul>
                    </div>
                    <a href="{{secure_url('admin/adverts/my')}}" class="btn btn-default">
                        <i class="fa fa-star"></i> Мои объявления
                    </a>
                    <a href="{{secure_url('admin/adverts/all')}}" class="btn btn-default">
                        <i class="fa fa-list-ul"></i> Все объявления
                    </a>
                </div>
                
                <div class="panel-body">
                    <!-- Отображение ошибок проверки ввода -->
                    @include('common.errors')
                    <div class="row">
                        <form action="{{secure_url('admin/adverts/save')}}" method="POST" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            <input type="text" hidden="" name="contractor_id" id="contractor_id" value="{{$contr->id}}"/>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Наименование</label>
                                <input type="text" class="form-control" name="name" value="{{Request::old('name')}}" placeholder="Наименование">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Описание</label>
                                <textarea class="form-control" id="descri_text" name="description" rows="3">{{Request::old('description')}}</textarea>
                            </div>
                            <div class="form-group">                                
                                <select style="" name="adv_cat" id="advt_cat" class="form-control">
                                    @foreach ($adv_cats as $cat)
                                        @if(Request::old('adv_cat') == $cat->id)
                                            <option selected value="{{$cat->id}}">{{$cat->name}}</option>
                                        @else
                                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                                        @endif
                                    @endforeach            
                                </select>
                            </div>
                            <label>Город-Цена</label>
                            <?php $count_name = 0;?>
                            @if(Request::old('advert_cits'))
                                <?php $advert_c = Request::old('advert_cits'); $prices = Request::old('prices'); $prices_two = Request::old('prices_two'); $dogovor = Request::old('dogovor'); ?>
                                @foreach($advert_c as $key=>$advc)
                                    @if($advc)
                                        @if(isset($dogovor[$key]))
                                            <!-- Если цена установленна как договорная то:-->
                                                <div class="form-group">
                                                    <div class="input-group cities_prices">
                                                        <select class="form-control advert_c" name="advert_cits[{{$count_name}}]">
                                                            @foreach($cities as $adv_cit)
                                                                @if($advc == $adv_cit->id)
                                                                    <option selected value="{{$adv_cit->id}}">{{$adv_cit->name}}</option>
                                                                @else
                                                                    <option value="{{$adv_cit->id}}">{{$adv_cit->name}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        <input type="text" class="form-control price1" name="prices[{{$count_name}}]" value="{{$prices[$key]}}" placeholder="Цена от">
                                                        <input type="text" class="form-control price2" name="prices_two[{{$count_name}}]" value="{{$prices_two[$key]}}" placeholder="Цена до">
                                                        <input name="dogovor[{{$count_name}}]" checked value="1" class="check_dog" type="checkbox"> Цена договорная
                                                        <span class="input-group-btn"><button type="button" class="btn btn-danger btn-remove">&#10060;</button></span>
                                                    </div>
                                                </div>
                                        @elseif($prices[$key] || $prices_two[$key])
                                            <!-- Если цена установленна не договорная а указанна конкретно то:-->
                                                <div class="form-group">
                                                    <div class="input-group cities_prices">
                                                        <select class="form-control advert_c" name="advert_cits[{{$count_name}}]">
                                                            @foreach($cities as $adv_cit)
                                                                @if($advc == $adv_cit->id)
                                                                    <option selected value="{{$adv_cit->id}}">{{$adv_cit->name}}</option>
                                                                @else
                                                                    <option value="{{$adv_cit->id}}">{{$adv_cit->name}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        <input type="text" class="form-control price1" name="prices[]" value="{{$prices[$key]}}" placeholder="Цена от">
                                                        <input type="text" class="form-control price2" name="prices_two[]" value="{{$prices_two[$key]}}" placeholder="Цена до">
                                                        <input name="dogovor[{{$count_name}}]" value="1" class="check_dog" type="checkbox"> Цена договорная
                                                        <span class="input-group-btn"><button type="button" class="btn btn-danger btn-remove">&#10060;</button></span>
                                                    </div>
                                                </div>
                                        @endif
                                    @endif
                                <?php $count_name++; ?>
                                @endforeach
                            @endif
                            <div class="form-group citker">
                                <div class="input-group cities_prices">
                                    <select class="form-control advert_c" name="advert_cits[{{$count_name}}]">
                                        <option value="" selected>Выберите город</option>
                                        @foreach($cities as $adv_cit)
                                            <option value="{{$adv_cit->id}}">{{$adv_cit->name}}</option>
                                        @endforeach
                                    </select>                                
                                    <input type="text" class="form-control price1" name="prices[{{$count_name}}]" placeholder="Цена от">
                                    <input type="text" class="form-control price2" name="prices_two[{{$count_name}}]" placeholder="Цена до">
                                    <input name="dogovor[{{$count_name}}]" value="1" class="check_dog" type="checkbox"> Цена договорная
                                    <span class="input-group-btn"><button type="button" class="btn btn-success btn-add">&#10010;</button></span>
                                </div>
                            </div>
                            <script>
                                var count_elem = $('.citker').length;
                                var count_needs = count_elem;
                                $(document).on('click', '.btn-add', function(event) {

                                    event.preventDefault();

                                    var field = $(this).closest('.citker');
                                    var field_new = field.clone();
                                    field_new.find('.advert_c').attr('name','advert_cits[' + count_needs + ']');
                                    field_new.find('.price1').attr('name','prices[' + count_needs + ']');
                                    field_new.find('.price2').attr('name','prices_two[' + count_needs + ']');
                                    field_new.find('.check_dog').attr('name','dogovor[' + count_needs + ']').removeAttr("checked");
                                    field_new.find('input').val('');
                                    field_new.find('.input-group-btn').html('<button type="button" class="btn btn-danger btn-remove">&#10060;</button>');
                                    field_new.insertAfter(field);
                                    count_needs++;
                                });

                                $(document).on('click', '.btn-remove', function(event) {
                                    event.preventDefault();
                                    $(this).closest('.citker').remove();
                                });
                            </script>
                            <div class="form-group">
                                <label>Ссылки на видео</label>
                                @if(Request::old('videos'))
                                    @foreach(Request::old('videos') as $video)
                                        @if($video)
                                            <div class="form-group input-group">
                                                <input type="text" name="videos[]" value="{{$video}}" class="form-control">
                                                <span class="input-group-btn"><button type="button" class="btn btn-danger btn-remove2">&#10060;</button></span>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                                <div class="form-group input-group">
                                    <input type="text" name="videos[]" class="form-control">
                                    <span class="input-group-btn"><button type="button" class="btn btn-success btn-add2">&#10010;</button></span>
                                </div>
                                <script>
                                    $(document).on('click', '.btn-add', function(event) {
                                    event.preventDefault();

                                    var field = $(this).closest('.input-group');
                                    var field_new = field.clone();

                                    field_new.find('.btn').removeClass('btn-success')
                                    field_new.find('.btn').toggleClass('btn-danger')
                                    field_new.find('.btn').removeClass('btn-add')
                                    field_new.find('.btn').toggleClass('btn-remove')
                                    field_new.find('.btn').html('&#10060;')
                                    field_new.find('input').val('')
                                    
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
                            <button type="submit" class="btn btn-primary">Добавить</button>
                        </form>
                        <script>
                            $(document).on('click', '.btn-add2', function(event) {
                                event.preventDefault();

                                var field = $(this).closest('.form-group');
                                var field_new = field.clone();

                                field_new.find('.btn').removeClass('btn-success')
                                field_new.find('.btn').toggleClass('btn-danger')
                                field_new.find('.btn').removeClass('btn-add2')
                                field_new.find('.btn').toggleClass('btn-remove2')
                                field_new.find('.btn').html('&#10060;')
                                field_new.find('input').val('')
                                field_new.insertAfter(field)
                            });

                            $(document).on('click', '.btn-remove2', function(event) {
                                event.preventDefault();
                                $(this).closest('.form-group').remove();
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

