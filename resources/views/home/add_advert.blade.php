@extends('layouts.app')

@section('content')
    <div class="body row">
        <div class="col-xs-12 col-md-4">
            <!-- Кнопка вызывающая модальное окно -->
            <button type="button" class="massive fluid ui teal basic button" data-toggle="modal" data-target="#myMedia"
                    id="123">
                <i class="plus icon"></i>
                Добавить медиа
            </button>
            <div class="col-xs-12 margin-top-always">
                <h3>Видео (3)</h3>
                <div class="row videoBlock"
                     style="height: 90px;overflow: auto;background: rgb(239, 240, 240); padding: 13px 6px;"></div>
            </div>
            <div class="col-xs-12 margin-top-always">
                <h3>Музыка (3)</h3>
                <div class="row" style="height: 90px;overflow: auto;background: rgb(239, 240, 240); padding: 13px 6px;">
                    <div class="col-xs-12">
                        <audio src="sound.mp3" controls class="col-xs-12"></audio>
                    </div>
                    <div class="col-xs-12">
                        <audio src="sound.mp3" controls class="col-xs-12 margin-top-always"></audio>
                    </div>
                    <div class="col-xs-12">
                        <audio src="sound.mp3" controls class="col-xs-12 margin-top-always"></audio>
                    </div>
                    <div class="col-xs-12">
                        <audio src="sound.mp3" controls class="col-xs-12 margin-top-always"></audio>
                    </div>
                    <div class="col-xs-12">
                        <audio src="sound.mp3" controls class="col-xs-12 margin-top-always"></audio>
                    </div>
                    <div class="col-xs-12">
                        <audio src="sound.mp3" controls class="col-xs-12 margin-top-always"></audio>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 margin-top-always">
                <h3>Фотографии (3)</h3>
                <div class="row" style="height: 90px;overflow: auto;background: rgb(239, 240, 240); padding: 13px 6px;">
                    <div class="col-xs-4">
                        <a href="//img.youtube.com/vi/XSGBVzeBUbk/1.jpg" data-lightbox="roadtrip">
                            <img src="//img.youtube.com/vi/XSGBVzeBUbk/1.jpg" class="img-responsive">
                        </a>
                    </div>
                    <div class="col-xs-4">
                        <a href="//img.youtube.com/vi/XSGBVzeBUbk/1.jpg" data-lightbox="roadtrip">
                            <img src="//img.youtube.com/vi/XSGBVzeBUbk/1.jpg" class="img-responsive">
                        </a>
                    </div>
                    <div class="col-xs-4">
                        <a href="//img.youtube.com/vi/XSGBVzeBUbk/1.jpg" data-lightbox="roadtrip">
                            <img src="//img.youtube.com/vi/XSGBVzeBUbk/1.jpg" class="img-responsive">
                        </a>
                    </div>
                    <div class="col-xs-4">
                        <a href="//img.youtube.com/vi/XSGBVzeBUbk/1.jpg" data-lightbox="roadtrip">
                            <img src="//img.youtube.com/vi/XSGBVzeBUbk/1.jpg" class="img-responsive">
                        </a>
                    </div>
                    <div class="col-xs-4">
                        <a href="//img.youtube.com/vi/XSGBVzeBUbk/1.jpg" data-lightbox="roadtrip">
                            <img src="//img.youtube.com/vi/XSGBVzeBUbk/1.jpg" class="img-responsive">
                        </a>
                    </div>
                    <div class="col-xs-4">
                        <a href="//img.youtube.com/vi/XSGBVzeBUbk/1.jpg" data-lightbox="roadtrip">
                            <img src="//img.youtube.com/vi/XSGBVzeBUbk/1.jpg" class="img-responsive">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Модальное окно -->
        <div class="modal fade body col-xs-12" id="myMedia" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Медиа</h4>
                    </div>
                    <div class="modal-body">
                        <!-- Вкладки навигации -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#home" aria-controls="home" role="tab"
                                   data-toggle="tab">Видео</a>
                            </li>
                            <li role="presentation">
                                <a href="#profile" aria-controls="profile" role="tab"
                                   data-toggle="tab">Музыка</a>
                            </li>
                            <li role="presentation">
                                <a href="#messages" aria-controls="messages" role="tab"
                                   data-toggle="tab">Фотографии</a>
                            </li>
                        </ul>

                        <!-- Вкладки -->
                        <div class="tab-content margin-top-always">
                            <div role="tabpanel" class="tab-pane active" id="home">
                                <div class="col-xs-12" style="float: none;">
                                    <form class="input-group" onsubmit="return false">
                                        <input type="url" class="form-control" id="youtube_videoId"
                                               placeholder='https://youtu.be/"введите videoId"' required>
                                        <span class="input-group-btn">
                                                <button class="btn btn-default addVideo">Добавить</button>
                                        </span>
                                    </form>
                                </div>
                                <div class="row video_panel"></div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="profile">

                            </div>
                            <div role="tabpanel" class="tab-pane" id="messages">

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"> Закрыть</button>
                        <button type="button" class="btn btn-primary saveVideoAdvert"> Сохранить изменения</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
