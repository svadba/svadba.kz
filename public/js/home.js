/**
 * Created by admin on 18.04.17.
 */

$(document).ready(function () {

    $('.delete_advert').on('click', function () {
        var id = $(this).attr('id');
        id = id.split('-');
        id = id[1];
        if (id) {
            var check = confirm('Вы действительно хотите удалить объявление ' + $(this).data('name') + ' c идентификатором ' + id);
            if (check) {
                $.ajax({
                    url: '/home/adverts/delete/' + id,
                    type: 'GET',
                    success: function (data) {
                        if (data = id) {
                            $('#advert-' + id).remove();
                        }
                    },
                    error: function () {
                        alert('Извините сервер не отвечает попробуйте позже');
                    }
                });
            }
        }
    });


    $('body').on('click', '.delAdvCit', function () {
        var id = $(this).attr('id');
        id = id.split('-');
        var advert_id = id[1];
        var cit_id = id[2];
        if (advert_id && cit_id) {
            $.ajax({
                url: '/home/adverts/cities/delete',
                type: 'POST',
                beforeSend: function () {
                    console.log(advert_id + ' ' + cit_id);
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    "adv_cit_id": cit_id,
                    "advert_id": advert_id
                },
                success: function (data) {
                    var mydata = JSON.parse(data);
                    if (mydata.result == true) {
                        $('#city-' + mydata.id).remove();
                    }
                    else {
                        switch (mydata.error) {
                            case 'error_autorization':
                                alert('Город не принадлежит Вам или этому объявлению!');
                                break;
                            case 'error_count':
                                alert('Невозможно удалить последний город в этом объявлении. Добавьте еще один город, чтобы удалить этот!');
                                break;
                        }
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert('Сервер ответил: ' + jqXHR.responseText);
                }
            });
        }
    });


    function add_adv_cit() {
        // custom form validation rule
        $.fn.form.settings.rules.sameCit = function (value) {

            var array_cits = [];
            var aded_cit = $('.addedCit');
            $.each(aded_cit, function (index, element) {
                array_cits.push($(element).val());
            });
            var return_a = true;
            $.each(array_cits, function (index, element) {
                if (value == element) {
                    return_a = false;
                }
            });

            return return_a;
        };


        $('.add_cit').form({
            inline: true,
            on: 'blur',
            fields: {
                advert_cits: {
                    identifier: 'advert_cits',
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'Пожалуйста, выберите город в котором готовы предоставить услугу'
                        },
                        {
                            type: 'sameCit',
                            prompt: 'Пожалуйста, выберите город который Вы еще не указывали'
                        }
                    ]
                },
                price: {
                    identifier: 'price',
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'Пожалуйста, заполните цену для указанного города'
                        },
                        {
                            type: 'integer[1..20000000]',
                            prompt: 'Поле должно содержать целое число в пределах от 0 до 20 000 000'
                        }
                    ]
                }
            },
            onSuccess: function (event, fields) {

                var advert_id = $('.add_cit').attr('id');
                advert_id = advert_id.split('-');
                advert_id = advert_id[1];

                $.ajax({
                    url: '/home/adverts/cities/add',
                    type: 'POST',
                    beforeSend: function () {
                    },
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        "advert_id": advert_id,
                        "cit_id": fields.advert_cits,
                        "price": fields.price
                    },
                    success: function (data) {
                        var mydata = JSON.parse(data);
                        if (mydata.result == true) {
                            var render = '' +
                                '<div class="card column" id="city-' + mydata.model.id + '">' +
                                '<div class="content">' +
                                '<div class="header"><i class="marker teal icon"></i>' + mydata.model.cit.name + '</div>' +
                                '<input type="hidden" value="' + mydata.model.cit.id + '" class="addedCit">' +
                                '<div class="description">' +
                                '<div class="ui pointing basic large label">' +
                                'от ' + mydata.model.price +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '<div class="ui red bottom attached button delAdvCit" id="del-' + advert_id + '-' + mydata.model.id + '"' +
                                '<i class="remove icon"></i>Удалить' +
                                '</div>' +
                                '</div>';
                            $('.added_cities').append(render);
                        }
                        else {
                            switch (mydata.error) {
                                case 'error_autenticate':
                                    alert('Объявление Вам не принадлежит!');
                                    break;
                                case 'error_add_model':
                                    alert('Город не добавлен! Сообщите, пожалуйста, об проблеме + 7 771 977 0333.');
                                    break;
                            }
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        var mydata = JSON.parse(jqXHR.responseText);
                        if (mydata) {
                            alert(mydata.cit_id[0]);
                        }
                        else {
                            alert('Сервер ответил: ' + jqXHR.responseText);
                        }
                    }
                });
            }
        });
    }

    add_adv_cit();

    $(function change_miniature_advert() {
        var forSelectMiniature = document.getElementById('forSelectMiniature'); //Элемент куда будут падать выбранные миниатюры либо ошибки!
        var div_for_errors = document.getElementById('div_for_errors');
        var image_upload = $('#image_upload');
        var body = $('body');
        var fileSet = false; //Опция выбран ли файл для загрузки!
        var fileToUpload; //тут будет файл который выбран в данный оммент для загрузки, по умолчанию undefined
        var xc,yc,wc,hc;
        var uploadMiniatureAdvert = $('.uploadMiniatureAdvert');
        uploadMiniatureAdvert.hide();
        forSelectMiniature.style.display = 'none';
        function checkCords()
        {
            console.log('checkcords start wc =' + wc);
            if(wc>0) return true;

        }

        body.on('click', '#change_miniature_advert', function () {
            console.log('start change_miniature_advert');
            $('.ui.modal_miniature').modal('show').modal({
                scroll: true,
                onHidden: function(){
                    forSelectMiniature.innerHTML = '';
                    div_for_errors.innerHTML = '';
                    uploadMiniatureAdvert.hide();
                    image_upload.prop('value', null);
                    forSelectMiniature.style.display = 'none';
                }
            });
        });

        body.on('change', '#image_upload', function () {
            div_for_errors.innerHTML = '';
            forSelectMiniature.innerHTML = '';
            forSelectMiniature.style.display = 'none';
            uploadMiniatureAdvert.hide();
            // Заполняем массив выбранными изображениями
            var file = $(this)[0].files;
            // Проверяем на максимальное количество файлов
            if (file.length > 0) {
                forSelectMiniature.innerHTML = '';
                fileToUpload = file[0];
                if (!(fileToUpload.type == 'image/png' || fileToUpload.type == 'image/jpeg')) {
                    var div_error = document.createElement('div');
                    div_error.className = 'ui negative message';
                    div_error.innerHTML = '<i class="close icon"></i><div class="header">Выбранный файл не является файлом формата JPG или PNG</div><p>Выберите другой формат файла</p>';
                    div_for_errors.appendChild(div_error);
                    uploadMiniatureAdvert.hide();
                    return false;
                }
                var fileReader = new FileReader();
                // Инициируем функцию FileReader
                fileReader.onload = function (event) {
                    forSelectMiniature.style.display = 'block';
                    var dataUri = event.target.result;
                    var img = document.createElement('img');
                    img.id = 'toCropImgId';
                    img.className = 'toCropImg';
                    img.src = dataUri;
                    forSelectMiniature.appendChild(img);
                    var toCropImg = document.getElementById('toCropImgId');
                    var cropper = new Cropper(toCropImg, {
                        aspectRatio:1 / 1,
                        crop: function(e) {
                            xc = e.detail.x;
                            yc = e.detail.y;
                            wc = e.detail.width;
                            hc = e.detail.height;
                            uploadMiniatureAdvert.show();
                            fileSet = true;
                        }
                    });
                };
                fileReader.onerror = function(event) {
                    var div_error = document.createElement('div');
                    div_error.className = 'ui negative message';
                    div_error.innerHTML = '<i class="close icon"></i><div class="header">Файл не может быть прочитан!</div><p>Код ошибки: ' + event.target.error.code + '</p>';
                    div_for_errors.appendChild(div_error);
                    return false;
                };
                fileReader.readAsDataURL(fileToUpload);
            }
        });

        body.on('click', '.imagesHaveToCrop', function()
        {
            div_for_errors.innerHTML = '';
            forSelectMiniature.innerHTML = '';
            forSelectMiniature.style.display = 'block';
            var img = document.createElement('img');
            img.id = 'toCropImgId';
            img.className = 'toCropImg';
            img.src = $(this).attr('src');
            forSelectMiniature.appendChild(img);
            var toCropImg = document.getElementById('toCropImgId');
            var cropper = new Cropper(toCropImg, {
                aspectRatio:1 / 1,
                crop: function(e) {
                    xc = e.detail.x;
                    yc = e.detail.y;
                    wc = e.detail.width;
                    hc = e.detail.height;
                    uploadMiniatureAdvert.show();
                    fileSet = true;
                }
            });
        });

        uploadMiniatureAdvert.on('click', function(){
            if(fileSet)
            {
                if(checkCords())
                {
                    var id = $(this).attr('id');
                    console.log(id);
                    id = id.split('-');
                    var myform = new FormData;
                    myform.append('image', fileToUpload);
                    myform.append('whois', id[1]);
                    myform.append('x', xc);
                    myform.append('y', yc);
                    myform.append('w', wc);
                    myform.append('h', hc);
                    $.ajax(
                        {
                            url: '/home/adverts/photos/set_advert_miniature',
                            type: 'POST',
                            processData: false,
                            contentType: false,
                            dataType: 'json',
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: myform,
                            beforeSend: function () {
                                console.log('start sent');
                            },
                            error: function (jqXHR) {
                                alert('Сервер ответил: ' + jqXHR.responseText);
                            },
                            success: function (data) {

                                console.log(data);
                                $('#mainAdvertImage').attr('src', 'https://svadba.kz/upload/begests/thumbs/' + data.photo.name + '.' + data.photo.ext);
                                $('.ui.modal_miniature').modal('hide');
                            }
                        }
                    );
                }
            }
        })



    });

    


});