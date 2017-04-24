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

    Route::get('/', 'MainPageController@mainPage');

    Route::get('/contacts', 'MainPageController@contacts');

    Route::get('/about', 'MainPageController@about');

    Route::get('/rules_and_help', 'MainPageController@rulesAndHelp');

    Route::get('/advertising', 'MainPageController@advertising');

    Route::get('/weddingPlan', 'MainPageController@weddingPlan');

    Route::get('/cities/{city}', ['as' => 'cities', 'uses' => 'CitController@mainPage']);
    Route::get('/city/by_id', 'CitController@by_id');

    Route::get('/like_svadba', 'MainPageController@like_svadba');

    Route::get('/advert/{advert}', 'AdvertController@advertPage');

    Route::group(['prefix' => 'services'], function(){
        Route::get('', 'ServicesController@all');
        Route::get('filter', 'ServicesController@by_filter');
        Route::post('get_adverts', 'ServicesController@ajax_get_adverts');
    });

    Route::get('basket/show', 'BasketController@showBasket');
    Route::post('basket/sent', 'BasketController@sentBasket');

    Route::auth();

    Route::get('/home', 'HomeController@index');

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
                        Route::get('delete_go/{basket_request}', "BasketController@delete_go")->middleware('role');
                    });

                });
            });
    });






    Route::get('/test_one', function() {return view('pages.good');});

    Route::any('/test_method', 'TestController@test_method');

    //Route::get('/addrole', 'AddRoleController@index');

