function AddToBasket(element, type) {
    var modal = document.getElementById('modal' + element + type);
    console.log(modal);
    var btn = document.getElementById("myBtn");
    var span = document.getElementsByClassName("close")[0];
    modal.style.display = "block";
    $(modal).fadeOut(3000);
    //Close function
    span.onclick = function () {
        modal.style.display = "none";
    };
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}

function load_musics_ajax() {

    // В dataTransfer помещаются изображения которые перетащили в область div
    jQuery.event.props.push('dataTransfer');
    var maxFiles = 10;
    var array_files = [];
    var errMessage = 0;
    var dataArray = [];
    var dataArray2 = [];
    var files; //переменная загруженных файлов
    var defaultUploadBtn = $('#uploadInputMusics'); //кнопка загрузки инпут
    var uploaded_holder = $('#uploaded-holder');
    var dropped_files = $('#droppedMusics');
    var loading = $(".loadingMusics");
    var loading_content = $('.loadingContentMusics');
    var loading_color = $('.loadingColorMusics');
    var readyItems = $('.readyMusics');
    var upload_button = $('.uploadButtonMusics'); //кнопка перекачки на сервер
    var uploaded_files = $('#uploaded-files');
    var imagesDir = $('.image');
    var body = $("body");
    var countItems = $('#countMusics');
    console.log('start');

    upload_button.hide();

    //Обрезка текста до 10 символов
    function cutLongText(text, size) {
        if (text.length > size) {
            text = text.slice(0, size);
        }
        return text;
    }

    // Процедура добавления эскизов на страницу
    function addImage(ind) {
        console.log('start addImage');
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
        }
        // Цикл для каждого элемента массива
        for (i = start; i < end; i++) {
            // размещаем загруженные изображения
            if (imagesDir.length <= maxFiles) {
                dropped_files.append('' +
                    '<div id="music-' + i + '" class="toLoadImage">' +
                        '<i class="file audio outline icon"></i>' +
                        '<span style="font-size:0.7em;" >' + cutLongText(dataArray[i].name, 20) + '</span>' +
                        '<div id="loadingDivMusics-' + i + '" class="loadingDivMusic">' +
                            '<div id="theLoadingMusics-' + i + '" class="theLoadingDivMusic"></div>' +
                        '</div>' +
                        '<a id="dropMusic-' + i + '" class="dropInMusic" title="Delete"><i class="remove icon" title="Удалить аудио из предзагрузки"></i></a>' +
                    '</div>');
            }
        }
        return false;
    }

    // Функция загрузки изображений на предросмотр
    function loadInView(files) {
        console.log('start loadInVIew');
        // Для каждого файла
        $.each(files, function (index, file) {
            // Несколько оповещений при попытке загрузить не изображение
            if ( files[index].type != 'audio/mp3'  ) {
                alert('Разрешенные аудиофайлы только формата "mp3"! ' + file.name);
                return false;
            }

            if ( files[index].size >= 20*1024*1024  ) {
                alert('Превышен максимальный размер файла 20мб! Файл - ' + file.name );
                return false;
            }

            // Проверяем количество загружаемых элементов
            if (!(dataArray.length + files.length <= maxFiles)) {
                // показываем область с кнопками
                alert('You can not upload more ' + maxFiles + ' images!');
                return;
            }
            array_files.push(file);
            // Создаем новый экземпляра FileReader
            var fileReader = new FileReader();
            // Инициируем функцию FileReader
            fileReader.onload = (function (file) {

                return function () {
                    // Помещаем URI изображения в массив
                    dataArray.push({name: file.name, value: this.result});
                    addImage((dataArray.length - 1));
                    console.log(file);
                };

            })(files[index]);
            // Производим чтение картинки по URI
            fileReader.readAsDataURL(file);
        });
        console.log(dataArray);
        if(array_files.length > 0) {
            // Показываем обасть предпросмотра
            uploaded_holder.show();
            // Показываем окнопку загрузки
            upload_button.show();
            console.log('upload show');
        }
        return false;
    }

    body.on('dragover', '#dropMusics', function (event) {
        event.preventDefault();
    });

    // Метод при падении файла в зону загрузки
    body.on('drop', '#dropMusics', function (e) {
        console.log('drop in #dropMusic');
        // Передаем в files все полученные изображения
        var files = e.dataTransfer.files;
        // Проверяем на максимальное количество файлов
        if (files.length + dataArray.length <= maxFiles) {
            // Передаем массив с файлами в функцию загрузки на предпросмотр
            loadInView(files);
        } else {
            alert('Вы не можете загрузить за один раз более ' + maxFiles + ' песен!');
            files.length = 0;
        }
    });

    // При нажатии на кнопку выбора файлов
    body.on('change', '#uploadInputMusics', function () {
        console.log('drop in #uploadInputMusics');
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
            alert('Вы не можете загрузить за один раз более ' + maxFiles + ' песен!');
            files.length = 0;
        }
    });

    // Простые стили для области перетаскивания
    body.on('dragenter', '#dropMusics', function () {
        return false;
    });

    body.on('drop', '#dropMusics', function () {
        return false;
    });

    // Удаление только выбранного изображения
    body.on("click", "a.dropInMusic", function () {
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

    body.on("click", "a.dropInMusic2", function () {
        // получаем название id
        var elid = $(this).attr('id');
        // делим строку id на 2 части
        var temp = elid.split('-');
        var deleteform = new FormData;
        deleteform.append('advert_id', temp[1]);
        deleteform.append('music_id', temp[2]);
        $.ajax({
            url: '/home/adverts/musics/delete',
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
                alert('Сервер не отвечает попробуйте позже!');
            },
            success: function (data) {
                if (data == temp[2]) {
                    $("div#readyMusic-" + temp[1] + '-' + temp[2]).remove();
                    countItems.html( Number(countItems.html()) - 1);
                    AddToBasket('Music', 'Del');
                }
            }
        });
    });


    // Загрузка на сервер
    body.on("click", ".uploadButtonMusics", function () {
        var advert_id = $(this).attr('id');
        var temp = advert_id.split('-');
        advert_id = temp[1];
        // Показываем прогресс бар
        loading.show();
        loading_color.css({'width': '0%'});
        loading_content.html('Загрузка начата!');
        // переменные для работы прогресс бара
        var totalPercent = 100 / dataArray.length;
        var x = 0;
        dataArray2 = dataArray;
        // Для каждого файла
        $.each(array_files, function (index, file) {
            //elem img this
            var elemImageDiv = $('#music-' + index);
            //elem load this
            var elemLoadDiv = $('#loadingDivMusics-' + index);
            //elem the load this
            var theElemLoadDiv = $('#theLoadingMusics-' + index);
            //elem loadgood img this
            //var theElemGoodImg = $('#goodImg-' + index);
            //record this file in form
            var myform = new FormData;
            myform.append('music', file);
            myform.append('advert_id', advert_id);
            //start ajax
            $.ajax({
                url: '/home/adverts/musics/add',
                type: 'POST',
                processData: false,
                contentType: false,
                dataType: 'json',
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                data: myform,
                beforeSend: function () {
                    elemLoadDiv.show();//add display:block;
                    theElemLoadDiv.css({'width': '15%'});
                    theElemLoadDiv.css({'width': '30%'});
                    theElemLoadDiv.css({'width': '47%'});
                },
                error: function (a, b, c) {
                    console.log(a);
                    console.log(b);
                    console.log(c);
                    alert('Сервер не отвечает! Попробуйте позже!');
                },
                success: function (data) {
                    console.log(data);
                    if (data.result == 'true') {
                        theElemLoadDiv.css({'width': '75%'});
                        theElemLoadDiv.css({'width': '100%'});
                        console.log('true');
                        ++x;
                        // Изменение бара загрузки
                        loading_color.css({'width': totalPercent * (x) + '%'});
                        $("div#music-" + index).remove();
                        readyItems.append('' +
                            '<div id="readyMusic-' + advert_id + '-' + data.music.id + '" class="readyMusic">' +
                                '<audio src="' + dataArray2[index].value + '" controls class="col-xs-12"></audio>' +
                                '<span class="col-xs-12">' + data.music.name + '</span>' +
                                '<a id="drop-' + advert_id + '-' + data.music.id + '" class="dropInMusic2" title="Delete"><i class="remove icon" title="Удалить аудио"></i></a>' +
                            '</div>');
                        AddToBasket('Music', 'Add');
                        countItems.html( Number(countItems.html()) + 1 );
                        upload_button.hide();
                        // Если загрузка закончилась
                        if (totalPercent * (x) == 100) {
                            // Загрузка завершена
                            loading_content.html('Загрузка завершена!');
                            // если еще продолжается загрузка
                        }
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

load_musics_ajax();
