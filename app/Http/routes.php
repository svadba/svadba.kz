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

    Route::get('/advert/{advert}', 'AdvertController@advertPage');

    Route::group(['prefix' => 'services'], function(){
        Route::get('', 'ServicesController@all');
        Route::get('filter', 'ServicesController@by_filter');
    });

    Route::auth();

    Route::get('/home', 'HomeController@index');

    Route::group(['middleware' => 'auth'], function(){

            Route::group(['prefix' => 'admin'], function(){
                Route::get('admin','AdminController@admin')->middleware('role');
                Route::get('blogAdmin','AdminController@blogAdmin')->middleware('role:2');
                Route::get('adManager','AdminController@adManager')->middleware('role:3');
                Route::get('requestManager','AdminController@requestManager')->middleware('role:4');
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

    });








    Route::get('/test_method', 'TestController@test_method');

    //Route::get('/addrole', 'AddRoleController@index');

