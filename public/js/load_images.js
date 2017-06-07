function load_images_ajax() {

    // В dataTransfer помещаются изображения которые перетащили в область div
    jQuery.event.props.push('dataTransfer');
    var maxFiles = 10;
    var array_files = [];
    var errMessage = 0;
    var dataArray = [];
    var dataArray2 = [];
    var files; //переменная загруженных файлов
    var defaultUploadBtn = $('#uploadbtn'); //кнопка загрузки инпут
    var uploaded_holder = $('#uploaded-holder');
    var dropped_files = $('#dropped-files');
    var sendme = $('#sendme');
    var ready_images = $('.readyImages');
    var upload_button = $('.upload-button'); //кнопка перекачки на сервер
    var imagesDir = $('.image');
    var body = $("body");
    var countPhotos = $('#countPhotos');
    var progress = $('#progresPhotos');

    upload_button.hide();
    progress.hide();

    // Процедура добавления эскизов на страницу
    function addImage(ind) {
        // Если индекс отрицательный значит выводим весь массив изображений
        if (ind < 0) {
            start = 0;
            end = dataArray.length;
        } else {
            // иначе только определенное изображение
            start = ind;
            end = ind + 1;
        }
        // Оповещения о загруженных файлах
        if (dataArray.length == 0) {
            // Если пустой массив скрываем кнопки и всю область
            upload_button.hide();
            uploaded_holder.hide();
            progress.hide();
        }
        // Цикл для каждого элемента массива
        for (i = start; i < end; i++) {
            // размещаем загруженные изображения
            if (imagesDir.length <= maxFiles) {
                dropped_files.append('' +
                    '<div id="img-' + i + '" class="toLoadImage">' +
                        '<div id="imgon-' + i + '" class="" >' +
                            '<a href="' + dataArray[i].value + '" data-lightbox="roadtrip">' +
                            '<img class="img-responsive" src="' + dataArray[i].value + '"/>' +
                            '</a>' +
                            '<div id="loadingDiv-' + i + '" class="loadingDiv">' +
                                '<div id="theLoadingImg-' + i + '" class="theLoadingDiv"></div>' +
                            '</div' +
                        '></div>' +
                        '<a id="drop-' + i + '" class="drop-button" title="Delete"><i class="remove icon" title="Удалить фото"></i></a>' +
                    '</div>');
            }
        }
        return false;
    }

    // Функция загрузки изображений на предросмотр
    function loadInView(files) {
        // Показываем обасть предпросмотра
        uploaded_holder.show();
        // Для каждого файла
        $.each(files, function (index, file) {

            // Несколько оповещений при попытке загрузить не изображение
            if (!files[index].type.match('image.*')) {
                alert('Для загрузки разрешенны файлы форматов jpg,png,bnp!');
                return false;
            }

            // Проверяем количество загружаемых элементов
            if ((dataArray.length + files.length) <= maxFiles) {
                // показываем область с кнопками
                upload_button.show();
                progress.show();
            }
            else {
                alert('Вы не можете загрузить за раз более' + maxFiles + ' изображений!');
                return;
            }
            array_files.push(file);
            // Создаем новый экземпляра FileReader
            var fileReader = new FileReader();
            // Инициируем функцию FileReader
            fileReader.onload = (function (file) {

                return function (e) {
                    // Помещаем URI изображения в массив
                    dataArray.push({name: file.name, value: this.result});
                    addImage((dataArray.length - 1));
                };

            })(files[index]);
            // Производим чтение картинки по URI
            fileReader.readAsDataURL(file);
        });
        return false;
    }

    body.on('dragover', '#drop-files', function (event) {
        event.preventDefault();
    });

    // Метод при падении файла в зону загрузки
    body.on('drop', '#drop-files', function (e) {
        // Передаем в files все полученные изображения
        var files = e.dataTransfer.files;
        // Проверяем на максимальное количество файлов
        if (files.length + dataArray.length <= maxFiles) {
            // Передаем массив с файлами в функцию загрузки на предпросмотр
            loadInView(files);
        } else {
            alert('Вы не можете загрузить за раз более' + maxFiles + ' изображений!');
            files.length = 0;
        }
    });

    // При нажатии на кнопку выбора файлов
    body.on('change', '#uploadbtn', function () {
        // Заполняем массив выбранными изображениями
        var files = $(this)[0].files;
        // Проверяем на максимальное количество файлов
        if (files.length + dataArray.length <= maxFiles) {
            // Передаем массив с файлами в функцию загрузки на предпросмотр
            loadInView(files);
            // Очищаем инпут файл путем сброса формы
            $('#frm').each(function () {
                this.reset();
            });
        } else {
            alert('Вы не можете загрузить за раз более' + maxFiles + ' изображений!');
            files.length = 0;
        }
    });

    // Простые стили для области перетаскивания
    body.on('dragenter', '#drop-files', function () {
        return false;
    });

    body.on('drop', '#drop-files', function () {
        return false;
    });

    // Удаление только выбранного изображения
    body.on("click", "a.drop-button", function () {
        // получаем название id
        var elid = $(this).attr('id');
        // создаем массив для разделенных строк
        var temp = elid.split('-');
        // получаем значение после тире тоесть индекс изображения в массиве
        dataArray.splice(temp[1], 1);
        array_files.splice(temp[1], 1);
        // Удаляем старые эскизы
        dropped_files.html("");
        // Обновляем эскизи в соответсвии с обновленным массивом
        addImage(-1);
    });

    body.on("click", "a.drop-button2", function () {
        // получаем название id
        var elid = $(this).attr('id');
        // делим строку id на 2 части
        var temp = elid.split('-');
        var deleteform = new FormData;
        deleteform.append('advert_id', temp[1]);
        deleteform.append('photo_id', temp[2]);
        $.ajax({
            url: '/home/adverts/photos/delete',
            type: 'POST',
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'text',
            data: deleteform,
            beforeSend: function () {

            },
            error: function () {
                alert('Сервер ответил: ' + jqXHR.responseText);
            },
            success: function (data) {
                if (data == temp[2]) {
                    $("div#readyImage-" + data).remove();
                    countPhotos.html( Number(countPhotos.html()) - 1);
                }
            }
        });
    });

    body.on("click", "a.set_main2", function () {
        // получаем название id
        var elid = $(this).attr('id');
        // делим строку id на 2 части
        var temp = elid.split('-');
        var deleteform = new FormData;
        deleteform.append('advert_id', temp[1]);
        deleteform.append('photo_id', temp[2]);
        $.ajax({
            url: '/home/adverts/photos/set_main',
            type: 'POST',
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'text',
            data: deleteform,
            beforeSend: function () {

            },
            error: function () {
                alert('Сервер ответил: ' + jqXHR.responseText);
            },
            success: function (data) {
                switch(data)
                {
                    case 'good':
                        $('.mainPhotoColor').removeClass('mainPhotoColor');
                        $('#main-'+ temp[1] + '-' + temp[2]).addClass('mainPhotoColor');
                        break;
                    case 'photo_is_main':
                        alert('Фотография является основным фото!')
                        break;
                    case 'photo_is_not_for_you':
                        alert('Это фото Вам не принадлежит!');
                        break;
                    default:
                        alert('Запрпос не прощел валидацию данных!');
                }
            }
        });
    });

    // Загрузка изображений на сервер
    body.on("click", ".upload-button", function () {
        var advert_id = $(this).attr('id');
        var temp = advert_id.split('-');
        advert_id = temp[1];
        dataArray2 = dataArray;
        // Для каждого файла
        $.each(array_files, function (index, file) {
            var myform = new FormData;
            myform.append('img', file);
            myform.append('advert_id', advert_id);
            //start ajax
            $.ajax({
                url: '/home/adverts/photos/add',
                type: 'POST',
                processData: false,
                contentType: false,
                dataType: 'json',
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                data: myform,
                beforeSend: function () {
                    progress
                        .progress({
                            value: 1,
                            total: dataArray.length,
                            text: {
                                ratio: '{value} из {total}',
                                active  : 'Загрузка {value} из {total} фотографий',
                                success : '{total} Фотографий загруженно!'
                            }
                        });
                },
                error: function (a, b, c) {
                    alert('Сервер ответил: ' + jqXHR.responseText);
                },
                success: function (data) {
                    console.log(data);
                    if (data.result == 'true') {
                        progress.progress('increment');
                        $("div#img-" + index).remove();
                        ready_images.append('' +
                            '<div id="readyImage-' + data.photo_id + '" class="readyImage">' +
                                '<div id="photo-' + advert_id + '-' + data.photo_id + '" class="">' +
                                    '<a href="' + dataArray2[index].value + '" data-lightbox="roadtrip">' +
                                    '<img src="' + dataArray2[index].value + '" class="img-responsive"/>' +
                                    '</a>' +
                                    '<i id="goodImg-' + index + '" class="check circle outline icon loadGoodImg disnone" title="Загруженно"></i>' +
                                '</div>' +
                                '<a id="drop-' + advert_id + '-' + data.photo_id + '" class="drop-button2" title="Delete"><i class="remove icon" title="Удалить фото"></i></a>' +
                                '<a id="main-' + advert_id + '-' + data.photo_id + '" class="set_main2" title="Set main"><i class="star icon" title="Сделать главным"></i></a>' +
                            '</div>');
                        countPhotos.html( Number(countPhotos.html()) + 1);
                        upload_button.hide();
                    }
                    else {
                        alert('Изображение не загруженно!');
                    }
                }
            });
        });
        array_files = [];
        dataArray = [];
        files = [];
        defaultUploadBtn.val("");
        return false;
    });


}

load_images_ajax();