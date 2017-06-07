<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

    Route::get('/', 'MainPageController@mainPage'); //good

    Route::get('/sitemap','SiteMapController@index'); //none

    Route::get('/cities/{city}', ['as' => 'cities', 'uses' => 'CitController@mainPage']); //good

    Route::get('/city/by_id', 'CitController@by_id'); //good

    Route::get('/like_svadba', 'MainPageController@like_svadba'); //none

    Route::get('/advert/{advert}', 'AdvertController@advertPage'); //good

    Route::group(['prefix' => 'ajax'], function(){
        Route::get('get_advert/{advert}', 'AdvertController@get_advert');
    });

    Route::group(['prefix' => 'combo'], function(){
        Route::get('{combo}/{combo_cit}', 'ComboController@viewUser'); //good
    });

    Route::get('/bakyt', 'ComboController@bakyt'); //good

    Route::group(['prefix' => 'services'], function(){
        Route::get('', 'ServicesController@all'); //good
        Route::get('filter', 'ServicesController@by_filter'); //good
        Route::post('get_adverts', 'ServicesController@ajax_get_adverts');
    });

    Route::get('basket/show', 'BasketController@showBasket'); //none
    Route::post('basket/sent', 'BasketController@sentBasket'); //none

    Route::auth();

    Route::group([ 'prefix' => 'home'], function(){
        Route::get('/','HomeController@index');

        Route::group(['prefix' => 'adverts'], function(){
            Route::get('add/{contractor}/step1', 'HomeController@add_advert_st1_get');
            Route::post('add/step1', 'HomeController@add_advert_st1_post');

            Route::get('edit/{advert}/step1', 'HomeController@edit_advert_st1_get');
            Route::post('edit/step1', 'HomeController@edit_advert_st1_post');

            Route::get('edit/{advert}/step2', 'HomeController@edit_advert_st2_get');
            Route::post('edit/step2', 'HomeController@edit_advert_st2_post');

            Route::get('edit/{advert}/step3', 'HomeController@edit_advert_st3_get');
            Route::post('edit/step3', 'HomeController@edit_advert_st3_post');

            Route::group(['prefix' => 'videos'], function(){
                Route::post('add', 'VideoController@add_ajax');
                Route::post('delete', 'VideoController@delete_ajax');
            });

            Route::group(['prefix' => 'musics'], function(){
                Route::post('add', 'MusicController@add_ajax');
                Route::post('delete', 'MusicController@delete_ajax');
            });

            Route::group(['prefix' => 'photos'], function(){
                Route::post('add', 'HomeController@save_advert_photo');
                Route::post('set_main', 'HomeController@setmain_advert_photo');
                Route::post('delete', 'HomeController@delete_advert_photo');
                Route::post('set_advert_miniature', 'PhotoController@ajax_set_advert_miniature');
            });

            Route::group(['prefix' => 'cities'], function(){
                Route::post('add', 'AdvertCitController@add_ajax');
                Route::post('delete', 'AdvertCitController@delete_ajax');
            });

            Route::get('{advert}', 'HomeController@open_advert');
            Route::get('delete/{advert}', 'HomeController@delete_advert');
        });
    });

    Route::group(['middleware' => 'auth'], function()
    {

            Route::group(['prefix' => 'admin'], function()
            {
                Route::get('admin','AdminController@admin')->middleware('role');
                Route::get('blogAdmin','AdminController@blogAdmin')->middleware('role:2');
                Route::get('adManager','AdminController@adManager')->middleware('role:3');
                Route::get('requestManager','AdminController@requestManager')->middleware('role:4');

                //group list_data
                Route::group(['prefix' => 'list_data', 'middleware' => 'role'], function()
                {
                    Route::get('cities','ListDataController@view_city');
                    Route::get('categories','ListDataController@view_category');

                    Route::group(['prefix' => 'city'], function()
                    {
                        Route::post('add','ListDataController@add_city');
                        Route::get('edit/{cit}','ListDataController@edit_city');
                        Route::get('delete_test/{cit}','ListDataController@delete_test_city');
                        Route::get('delete/{cit}','ListDataController@delete_city');
                    });

                    Route::group(['prefix' => 'category'], function()
                    {
                        Route::post('add','ListDataController@add_category');
                        Route::get('edit/{advert_categor}','ListDataController@edit_category');
                        Route::get('delete_test/{advert_categor}','ListDataController@delete_test_category');
                        Route::get('delete/{advert_categor}','ListDataController@delete_category');
                    });
                });

                //group contractor
                Route::group(['prefix' => 'contractors'], function(){
                    Route::get('my','ContController@my')->middleware('role:3');
                    Route::get('all','ContController@all')->middleware('role:3');
                    Route::get('add','ContController@add')->middleware('role:3');
                    Route::post('save','ContController@save')->middleware('role:3');
                    Route::get('view/{contractor}','ContController@view')->middleware('role:3');
                    Route::get('edit/{contractor}','ContController@edit')->middleware('role:3');
                    Route::post('edit_go','ContController@edit_go')->middleware('role:3');
                    Route::get('delete/{contractor}','ContController@delete')->middleware('role:3');
                });

                //group advert
                Route::group(['prefix' => 'adverts'], function(){
                    Route::get('my', 'AdvertController@my')->middleware('role:3');
                    Route::get('all', 'AdvertController@all')->middleware('role:3');
                    Route::post('save', 'AdvertController@save')->middleware('role:3');
                    Route::get('add/{contractor}', 'AdvertController@add')->middleware('role:3');
                    Route::get('allow/{advert}', 'AdvertController@allow')->middleware('role');
                    Route::get('unallow/{advert}', 'AdvertController@unallow')->middleware('role');
                    Route::get('edit/{advert}', 'AdvertController@edit')->middleware('role:3');
                    Route::post('edit_go', 'AdvertController@edit_go')->middleware('role:3');
                    Route::get('delete/{advert}', 'AdvertController@delete')->middleware('role:3');
                });

                Route::group(['prefix' => 'phones'], function(){
                    Route::get('delete/{phone}', 'PhoneController@delete')->middleware('role:3');
                });

                Route::group(['prefix' => 'photos'], function(){
                    Route::get('delete/{photo}', 'PhotoController@delete')->middleware('role:3');
                    Route::get('set_main/{photo}', 'PhotoController@set_main')->middleware('role:3');
                });

                Route::group(['prefix' => 'advert_cits'], function(){
                    Route::get('delete/{advert_cit}', 'AdvertCitController@delete')->middleware('role:3');
                });

                Route::group(['prefix' => 'requests'], function(){
                    Route::get('baskets', "BasketController@basket_requests")->middleware('role:4');
                    Route::group(['prefix' => 'basket'], function(){
                        Route::get('set_end/{basket_request}', "BasketController@set_end")->middleware('role:4');
                        Route::get('set_no_end/{basket_request}', "BasketController@set_no_end")->middleware('role:4');
                        Route::get('{basket_request}', "BasketController@view_admin")->middleware('role:4');
                        Route::post('save', "BasketController@save")->middleware('role:4');
                        Route::post('save_adverts/{basket_request}', "BasketController@save_adverts_in_basket")->middleware('role:4');
                        Route::post('save_tusa/{basket_request}', "BasketController@save_tusa_date")->middleware('role:4');
                        Route::get('delete_advert/{basket_request}',"BasketController@delete_advert")->middleware('role:4');
                        Route::post('delete_adverts/{basket_request}',"BasketController@delete_adverts")->middleware('role:4');
                        Route::get('delete/{basket_request}', "BasketController@delete")->middleware('role');
                        //ajax combo_request
                        Route::post('edit_combo_adverts/{combo_request}', 'BasketController@edit_combo_adverts')->middleware('role:4');
                        Route::get('delete_combo/{combo_request}', 'BasketController@delete_combo')->middleware('role:4');
                    });

                });

                Route::group(['prefix' => 'combos'], function(){
                    Route::get('all', "ComboController@all")->middleware('role');
                    Route::get('add', "ComboController@add")->middleware('role');
                    Route::post('save', "ComboController@save")->middleware('role');
                    Route::group(['prefix' => 'ajax'], function(){

                        Route::get('get_cities', 'ComboController@get_cities')->middleware('role');
                        Route::post('set_cities/{combo}', 'ComboController@set_cities')->middleware('role');
                        Route::get('delete_city/{combo_cit}', 'ComboController@delete_city')->middleware('role');

                        Route::get('get_categories', 'ComboController@get_categories')->middleware('role');
                        Route::post('set_categories/{combo_cit}', 'ComboController@set_categories')->middleware('role');
                        Route::get('delete_category/{combo_cit_categor}', 'ComboController@delete_category')->middleware('role');

                        Route::post('get_adverts', 'ComboController@get_adverts')->middleware('role');
                        Route::post('set_adverts/{combo_cit_categor}', 'ComboController@set_adverts')->middleware('role');
                        Route::get('delete_advert/{combo_cit_categor_advert}', 'ComboController@delete_advert')->middleware('role');
                    });
                });

            });
    });



    Route::get('/test_one', function() {return view('pages.good');});

    Route::any('/test_method', 'TestController@test_method');

    Route::get('/test_youtube', 'TestController@test_youtube'); //good
    //Route::get('/addrole', 'AddRoleController@index');

