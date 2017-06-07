@extends('layouts.app')

@section('content')
    <style>
        .mainPhotoColor {
            color: #fab10a;
        }
        .toCropImg{
            max-width:100%;
            max-height:100%;
            width:auto!important;;
        }
    </style>
    <div class="body">
        <div class="ui stackable grid">
            <div class="eight wide tablet four wide computer column">
                <div class="ui raised segment center aligned special cards">
                    <div class="card" style="margin-left: auto; margin-right: auto">
                        <div class="blurring dimmable image">
                            <div class="ui inverted dimmer">
                                <div class="content">
                                    <div class="center">
                                        <div id="change_miniature_advert" class="ui primary button "><i class="photo icon"></i>Изменить</div>
                                    </div>
                                </div>
                            </div>
                            <img id="mainAdvertImage" src="{{secure_asset($advert->photo_main())}}">
                        </div>
                    </div>
                    <button class="fluid ui button margin-top-always">Редактировать</button>
                </div>
            </div>
            <div class="eight wide column">
                <div class="ui raised segments">
                    <div class="ui segment" style="overflow: auto;">
                        <h1 class="ui header">
                            {{$advert->name}}
                            @if($advert->allow_type_id == 1)
                                <button class="ui right floated basic positive button"
                                        title="Ваше объявление одобренно администратраторами портала!">{{$advert->allow_type->name}}</button>
                            @elseif($advert->allow_type_id == 3)
                                <button class="ui right floated basic orange button"
                                        title="Ваше объявление на рассмотрении у администраторов портала!">{{$advert->allow_type->name}}</button>
                            @else
                                <button class="ui right floated basic negative button"
                                        title="Ваше объявление не одобренно администраторами портала!">{{$advert->allow_type->name}}</button>
                            @endif
                            @if($advert->advert_stat_id == 1)
                                <button class="ui right floated basic positive button"
                                        title="Статус объявления. На данный момент объявление показанно посетителям. Нажмите на эту кнопку, чтобы скрыть объявление.">{{$advert->advert_stat->name}}</button>
                            @else
                                <button class="ui right floated basic negative button"
                                        title="Статус объявления. На данный момент объявление скрыто от посетителей. Нажмите на эту кнопку, чтобы показать объявление.">{{$advert->advert_stat->name}}</button>
                            @endif
                        </h1>
                    </div>
                    <div class="ui segment">
                        <table class="ui unstackable very basic collapsing table">
                            <tbody>
                            <tr>
                                <td>
                                    <div class="ui teal ribbon label">Рейтинг:</div>
                                </td>
                                <td>
                                    <div class="ui heart rating" data-rating="{{$advert->rating}}"
                                         data-max-rating="5"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="ui teal ribbon label">Просмотры:</div>
                                </td>
                                <td>{{$advert->views}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="ui teal ribbon label">Категория:</div>
                                </td>
                                <td>{{$advert->advert_categor->name}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="ui teal ribbon label">Города:</div>
                                </td>
                                <td>
                                    @foreach($advert->advert_cits as $adv_cit)
                                        <div id="city-{{$adv_cit->id}}">
                                            {{$adv_cit->cit->name}}
                                            <a id="del-{{$advert->id}}-{{$adv_cit->id}}" class="delAdvCit">
                                                <i class="red icon trash" title="Удалить город"></i>
                                            </a>
                                        </div>
                                    @endforeach
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="ui segment center aligned"></div>
                </div>
            </div>
            <div class="sixteen wide tablet four wide computer column">

            </div>
            <div class="sixteen wide tablet twelve wide computer column">
                <div class="ui raised segment">
                    <div class="ui form">
                        <div class="field">
                            <label>Описание</label>
                            <textarea><?php echo $advert->description; ?></textarea>
                        </div>
                    </div>
                    <button class="positive ui button margin-top-always">Сохранить</button>
                </div>
                <div class="ui raised segment">
                    <p>Раздел личного блога в разработке</p>
                </div>
            </div>
            <div class="sixteen wide tablet four wide computer column">
                <div class="col-xs-12 margin-top-always padding-0-always">
                    <div class="fluid ui buttons">
                        <button class="text-left ui teal basic button">
                            <i class="video icon"></i>Видео (<span
                                    id="countVideos">{{$advert->videos->count()}}</span>)
                        </button>
                        <!-- Кнопка вызывающая модальное окно -->
                        <button type="button" class="ui teal button" data-toggle="modal" data-target="#myVideo">
                            <i class="plus icon"></i>
                        </button>
                    </div>
                    <div class="col-xs-12 videoBlock">
                        @foreach($advert->videos as $video)
                            <div id="video-{{$video->id}}" class="col-xs-6 col-sm-4 col-md-6 margin-top-always">
                                <a href="//www.youtube.com/watch?v={{$video->youtube_video_id}}" data-lity
                                   style="width:100%;">
                                    <img src="//img.youtube.com/vi/{{$video->youtube_video_id}}/1.jpg"
                                         class="img-responsive center-block"
                                         id="{{$video->youtube_video_id}}">
                                </a>
                                <button class="fluid mini ui negative button delvideoInBase"
                                        id="delvideo-{{$advert->id}}-{{$video->id}}"
                                        style="border-top-left-radius: 0;border-top-right-radius: 0;">
                                    <i class="remove icon" title="Удалить видео"></i>
                                </button>
                            </div>
                        @endforeach
                        <div class="col-xs-12" style="height: 15px"></div>
                    </div>
                </div>
                <div class="col-xs-12 margin-top-always padding-0-always">
                    <div class="fluid ui buttons">
                        <button class="text-left ui teal basic button">
                            <i class="music icon"></i>Музыка (<span
                                    id="countMusics">{{$advert->musics->count()}}</span>)
                        </button>
                        <label class="ui teal button" for="uploadInputMusics">
                            <i class="plus icon"></i>
                        </label>
                    </div>
                    <div id="dropMusics" class="col-xs-12 musicBlock">
                        <div style="margin: 0.5em 0 2em;" class="ui indicating progress" id="progresMusics">
                            <div class="bar">
                            </div>
                            <div class="label">Нажмите кнопку загрузить!</div>
                        </div>
                        <div id="droppedMusics" class="toLoadImages"></div>
                        <div id="upload-{{$advert->id}}" class="uploadButtonMusics fluid ui green button">
                            <i class="upload icon"></i>Загрузить
                        </div>
                        <div class="readyMusics">
                            @foreach($advert->musics as $music)
                                <div id="readyMusic-{{$music->id}}"
                                     class="readyMusic col-xs-12 margin-top-always">
                                    <span class="col-xs-10">{{$music->name}}</span>
                                    <a id="drop-{{$advert->id}}-{{$music->id}}"
                                       class="dropInMusic2 col-xs-2 text-right"
                                       title="Delete"><i class="remove icon" title="Удалить аудио"></i></a>
                                    <audio src="{{secure_asset($music->path)}}" controls class="col-xs-12"></audio>
                                </div>
                            @endforeach
                            <div class="col-xs-12" style="height: 15px"></div>
                        </div>
                        <input style="display: none;" type="file" name="uploadInputMusics" id="uploadInputMusics"
                               class="inputfile" multiple/>
                    </div>
                </div>
                <div class="col-xs-12 margin-top-always padding-0-always">
                    <div class=" fluid ui buttons">
                        <button class="text-left ui teal basic button">
                            <i class="photo icon"></i>Фотографии (<span
                                    id="countPhotos">{{$advert->photos->count()}}</span>)
                        </button>
                        <label class="ui teal button" for="uploadbtn">
                            <i class="plus icon"></i>
                        </label>
                    </div>
                    <div id="drop-files" class="photoBlock">
                        <div style="margin: 0.5em 0 2em;" class="ui indicating progress" id="progresPhotos">
                            <div class="bar">

                            </div>
                            <div class="label">Нажмите кнопку загрузить!</div>
                        </div>
                        <div id="dropped-files" class="toLoadImages"></div>
                        <div id="upload-{{$advert->id}}" class="upload-button fluid ui green button">
                            <i class="upload icon"></i>Загрузить
                        </div>
                        <div class="readyImages margin-top-always">
                            @foreach($advert->photos as $photo)
                                <div id="readyImage-{{$photo->id}}" class="readyImage">
                                    <a href="{{secure_url($photo->path)}}" data-lightbox="roadtrip">
                                        <img src="{{secure_asset($photo->path)}}"
                                             class="img-responsive">
                                    </a>
                                    @if($photo->main)
                                        <a id="main-{{$advert->id}}-{{$photo->id}}"
                                           class="set_main2 mainPhotoColor" title="Set main"><i class="star icon"
                                                                                                title="Главное фото"></i></a>
                                    @else
                                        <a id="main-{{$advert->id}}-{{$photo->id}}" class="set_main2"
                                           title="Set main"><i class="star icon" title="Сделать главным"></i></a>
                                    @endif
                                    <a id="drop-{{$advert->id}}-{{$photo->id}}" class="drop-button2" title="Delete"><i
                                                class="remove icon" title="Удалить фото"></i></a>
                                </div>
                            @endforeach
                        </div>
                        <input style="display: none;" type="file" name="uploadbtn" id="uploadbtn" class="inputfile"
                               multiple/>
                    </div>
                </div>
            </div>
        </div>
        <!-- Модальное окно -->
        <div class="modal fade body col-xs-12" id="myVideo" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Добавить видео</h4>
                    </div>
                    <div class="modal-body" style="display:inline-block;">
                        <div class="input-group">
                            <input type="url" class="form-control" id="youtube_videoId"
                                   placeholder='https://youtu.be/"введите videoId"' required>
                            <span class="input-group-btn">
                                        <button type="button" class="btn btn-default addVideo">Добавить</button>
                                    </span>
                        </div>
                        <div class="row videoPanel"></div>
                    </div>
                    <div class="modal-footer">
                        <div class="ui buttons">
                            <button type="button" class="ui button" data-dismiss="modal">Закрыть</button>
                            <div class="or" data-text="или"></div>
                            <button id="advert-{{$advert->id}}" type="button"
                                    class="ui positive button saveVideoAdvert" data-dismiss="modal">Сохранить
                                изменения
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ui modal modal_miniature">
        <i class="close icon"></i>
        <div class="header">
            Редактирование миниатюры объявления
        </div>
        <div class="content">
            <p>Вы можете загрузить изображение в формате JPG и PNG.</p>
            <div style="margin:30px 0;">
                <label style="background:#26b; text-align:center; margin-right:10px;" class="ui labeled icon button" for="image_upload">
                    <i class="plus icon"></i> Выбрать файл
                </label>
                <div id="adfde-{{$advert->id}}" class="ui positive labeled icon button uploadMiniatureAdvert">
                    <i class="upload icon"></i> Загрузить
                </div>
                <input hidden type="file" name="image_upload" id="image_upload"/>

                <div style="height:330px; width:auto; margin:0 auto;" id="forSelectMiniature">
                </div>
                <div id="div_for_errors">

                </div>
            </div>
            <p>Либо выберите одно из ранее загруженных фото</p>
            <div style="padding:10px; border-top:1px solid rgba(34,36,38,.15);">
                @foreach($advert->photos as $photo)
                    <img id="photo-{{$photo->id}}" style="display:inline-block; margin:0 5px 5px 0; height:70px; width:auto; border:1px solid gray;" src="{{secure_url($photo->path)}}"/>
                @endforeach
            </div>
        </div>
        <div class="actions">
            <div class="ui black deny button">
                Отменить
            </div>
        </div>
    </div>
@endsection
