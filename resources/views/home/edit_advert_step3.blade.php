@extends('layouts.app')

@section('content')
    <style>
        .mainPhotoColor {
            color: #fab10a;
        }
    </style>
    <div class="body row text-center">
        <div class="ui tablet stackable steps">
            <a href="{{secure_url('/home/adverts/edit/'.$advert->id.'/step1')}}" class="step">
                <i class="edit icon"></i>
                <div class="content">
                    <div class="title">Описание</div>
                    <div class="description">Введите основную информацию</div>
                </div>
            </a>
            <a href="{{secure_url('/home/adverts/edit/'.$advert->id.'/step2')}}" class=" step">
                <i class="dollar icon"></i>
                <div class="content">
                    <div class="title">Прайс</div>
                    <div class="description">Укажите цены для городов</div>
                </div>
            </a>
            <a href="{{secure_url('/home/adverts/edit/'.$advert->id.'/step3')}}" class="active step">
                <i class="play icon"></i>
                <div class="content">
                    <div class="title">Медиа</div>
                    <div class="description">Добавьте медиа-контент</div>
                </div>
            </a>
        </div>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form class="col-xs-12 body">
            {{csrf_field()}}
            <input type="hidden" value="{{$advert->id}}" name="advert">
            <div class="col-xs-12 col-sm-6 col-md-4 margin-top-always">
                <div class="fluid ui buttons">
                    <button class="text-left ui teal basic button">
                        <i class="video icon"></i>Видео (<span id="countVideos">{{$advert->videos->count()}}</span>)
                    </button>
                    <!-- Кнопка вызывающая модальное окно -->
                    <button type="button" class="ui teal button" data-toggle="modal" data-target="#myVideo">
                        <i class="plus icon"></i>
                    </button>
                </div>
                <div class="col-xs-12 videoBlock">
                    @foreach($advert->videos as $video)
                        <div id="video-{{$video->id}}" class="col-xs-6 col-md-4 margin-top-always">
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
            <div class="col-xs-12 col-sm-6 col-md-4 margin-top-always">
                <div class="fluid ui buttons">
                    <button class="text-left ui teal basic button">
                        <i class="music icon"></i>Музыка (<span id="countMusics">{{$advert->musics->count()}}</span>)
                    </button>
                    <label class="ui teal button" for="uploadInputMusics">
                        <i class="plus icon"></i>
                    </label>
                </div>
                <div id="dropMusics" class="col-xs-12 musicBlock">
                    <div style="margin: 0.5em 0 1em;" class="ui indicating progress" id="progresMusics">
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
                            <div id="readyMusic-{{$advert->id}}-{{$music->id}}"
                                 class="readyMusic col-xs-12 margin-top-always">
                                <span class="col-xs-10">{{$music->name}}</span>
                                <a id="drop-{{$advert->id}}-{{$music->id}}" class="dropInMusic2 col-xs-2 text-right"
                                   title="Delete"><i class="remove icon" title="Удалить аудио"></i></a>
                                <audio src="{{secure_asset($music->path)}}" controls class="col-xs-12"></audio>
                            </div>
                        @endforeach
                        <div class="col-xs-12" style="height: 15px"></div>
                    </div>
                    <input style="display: none;" type="file" name="uploadInputMusics" id="uploadInputMusics"
                           class="inputfile" multiple/>
                    <div class="loadingMusics col-xs-12">
                        <div class="loadingBarMusics">
                            <div class="loadingColorMusics"></div>
                        </div>
                        <div class="loadingContentMusics"></div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 margin-top-always">
                <div class=" fluid ui buttons">
                    <div class="text-left ui teal basic button">
                        <i class="photo icon"></i>Фотографии (<span id="countPhotos">{{$advert->photos->count()}}</span>)
                    </div>
                    <label class="ui teal button" for="uploadbtn">
                        <i class="plus icon"></i>
                    </label>
                </div>
                <div id="drop-files" class="photoBlock">
                    <div class="ui indicating progress" id="progresPhotos">
                        <div class="bar">
                        </div>
                        <div class="label">Нажмите кнопку загрузить</div>
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
                           data-multiple-caption="{count} files selected" multiple/>
                </div>
            </div>
            <a href="{{secure_url('/home')}}"
               class="big margin-top-always pull-right ui positive button md-margin-right">
                <i class="checkmark icon"></i>
                Завершить
            </a>
        </form>
    </div>
    <div id="modalMusicDel" class="AddToBasket" style="display: none;">
        <div class="AddToBasket-content">
            <span class="close">×</span>
            <p>Аудиозапись удалена!</p>
        </div>
    </div>
    <div id="modalMusicAdd" class="AddToBasket" style="display: none;">
        <div class="AddToBasket-content">
            <span class="close">×</span>
            <p>Аудиозаписать добавлена!</p>
        </div>
    </div>
    <div id="modalPhotoAdd" class="AddToBasket" style="display: none;">
        <div class="AddToBasket-content">
            <span class="close">×</span>
            <p>Фото добавлено!</p>
        </div>
    </div>
    <div id="modalPhotoDel" class="AddToBasket" style="display: none;">
        <div class="AddToBasket-content">
            <span class="close">×</span>
            <p>Фото удалено!</p>
        </div>
    </div>
@endsection
