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
                    <a href="{{secure_url('admin/combos/all')}}" class="btn btn-default">
                        <i class="fa fa-list-ul"></i> Все пакеты
                    </a>
                    <a href="{{secure_url('admin/combos/add')}}" class="btn btn-default">
                        <i class="fa fa-plus"></i> Добавить пакет
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
                            <th style="background: #e6e6e6;">Функции</th>
                        </tr>
                        @foreach($combos as $combo)
                            <tr id="combo-{{$combo->id}}" style="border-top:green 2px solid;">
                                <td>{{$combo->id}}</td>
                                <td>{{$combo->name}}</td>
                                <td>{{$combo->name_eng}}</td>
                                <td>{{$combo->description}}</td>
                                <td>{{$combo->price}}</td>
                                <td style="width: 172px; text-align: right;">
                                    <a href="#modalCity" id="addcity-{{$combo->id}}" class="btn btn-primary btn_city" data-toggle="modal"><i class="fa fa-plus"></i></a>
                                    <a class="btn btn-info" title="Открыть пакет" href="{{secure_url('admin//combos/view/'.$combo->id)}}"><i class="fa fa-external-link"></i></a>
                                    <a class="btn btn-warning" title="Редактировать пакет" href="{{secure_url('admin/combos/edit/'.$combo->id)}}"><i class="fa fa-pencil"></i></a>
                                    <a class="btn btn-danger" title="Удалить пакет" href="{{secure_url('admin/combos/delete/'.$combo->id)}}"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                            @foreach($combo->combo_cits as $combo_cit)
                            <tr id='to_del_city-{{$combo_cit->id}}'>
                                <td colspan="6">
                                    <span style="color:red;font-size:16px; float:left;">{{$combo_cit->cit->name}}</span>
                                    <label class="btn btn-danger delete_city_main" title='Удалить город' style='float:right; padding:0 3px;' id="delcit-{{$combo_cit->id}}"><i class="fa fa-trash-o"></i></label>
                                    <a href="#modalCategory" id="addcat-{{$combo_cit->id}}" class="btn btn-primary btn_category" style='float:right; padding:0 3px;' title='Добавить категорию' data-city='{{$combo_cit->cit->id}}' data-toggle="modal"><i class="fa fa-plus"></i></a>
                                    <table class='table table-striped table-bordered table-hover table-condensed' style="margin-top:10px;">
                                        <tr>
                                            <td colspan="6" style="text-align:left;" id="combocit-{{$combo_cit->id}}">
                                                @foreach($combo_cit->combo_categors as $category)
                                                    <div style='padding:5px; margin:10px; display:inline-block; text-align:left; border:1px solid black;' id='combocitcategor-{{$category->id}}'>
                                                        <span style='color:blue; font-size:14px; margin-right:10px;'>{{$category->advert_categor->name}}</span>
                                                        <label class='btn btn-danger delete_category_main' title='Удалить категорию' style='float:right; padding:0 3px;' id='delcategory-{{$category->id}}'><i class='fa fa-trash-o'></i></label>
                                                        <a href="#modalAdvert" id='addadvert-{{$category->id}}-{{$combo_cit->cit_id}}-{{$category->advert_categor_id}}' class="btn btn-primary btn_advert" style='float:right; padding:0 3px;' title='Добавить объявление' data-toggle="modal"><i class="fa fa-plus"></i></a>
                                                        @foreach($category->adverts as $advert)
                                                            <div id="advert-{{$advert->pivot->id}}">
                                                                <span style='color:green; font-size:14px; margin:3px 0px;'><a href="{{'/advert/'.$advert->id}}">{{$advert->name}}</a></span>
                                                                <label class='btn btn-danger delete_advert_main' title='Удалить объявление' style=' padding:0 3px;' id='deladvert-{{$advert->pivot->id}}'><i class='fa fa-trash-o'></i></label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            @endforeach
                        @endforeach
                    </table>
                    <div id="modalCity" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Заголовок модального окна -->
                                <div class="modal-header">
                                    <button type="button" class="close close_cities" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title">Добавление городов</h4>
                                </div>
                                <!-- Основное содержимое модального окна -->
                                <div class="modal-body">
                                    <p>Выберите из списка нужные города</p>
                                    <button style="margin:15px 0px;" id="go_search" class="btn btn-info"><i class="fa fa-binoculars"></i>Получить список</button>
                                    <div id="geted_cities"></div>
                                    <div id="cities_to_add"></div>
                                </div>
                                <!-- Футер модального окна -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default close_cities" data-dismiss="modal">Закрыть</button>
                                    <button type="button" id="sent_city_to_server" data-dismiss="modal" class="btn btn-primary">Сохранить изменения</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="modalCategory" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Заголовок модального окна -->
                                <div class="modal-header">
                                    <button type="button" class="close close_categories" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title">Добавление категорий</h4>
                                </div>
                                <!-- Основное содержимое модального окна -->
                                <div class="modal-body">
                                    <p>Выберите из списка нужные категории</p>
                                    <button style="margin:15px 0px;" id="go_search_categories" class="btn btn-info"><i class="fa fa-binoculars"></i>Получить список</button>
                                    <div id="geted_categories"></div>
                                    <div id="categories_to_add"></div>
                                </div>
                                <!-- Футер модального окна -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default close_categories" data-dismiss="modal">Закрыть</button>
                                    <button type="button" id="sent_category_to_server" data-dismiss="modal" class="btn btn-primary">Сохранить изменения</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="modalAdvert" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Заголовок модального окна -->
                                <div class="modal-header">
                                    <button type="button" class="close close_advert" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title">Добавление объявлений</h4>
                                </div>
                                <!-- Основное содержимое модального окна -->
                                <div class="modal-body">
                                    <p>Выберите из списка нужные категории</p>
                                    <button style="margin:15px 0px;" id="go_search_adverts" class="btn btn-info"><i class="fa fa-binoculars"></i>Получить список</button>
                                    <div id="geted_adverts"></div>
                                    <div id="adverts_to_add"></div>
                                </div>
                                <!-- Футер модального окна -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default close_advert" data-dismiss="modal">Закрыть</button>
                                    <button type="button" id="sent_adverts_to_server" data-dismiss="modal" class="btn btn-primary">Сохранить изменения</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript" src="{{secure_asset('admin_wp/js/combo_ajax.js')}}"></script>
        </div>
    </div>
</div>
@endsection
