<?php

Route::group(['prefix' => 'v1','namespace' => 'API',], function () {

    Route::group(['namespace' => 'User',], function () {

/* Registration User*/

        Route::post('register', 'UsersAPIController@register');
        Route::post('users/{user}', 'UsersAPIController@update');
        Route::post('users-delete/{user}', 'UsersAPIController@destroy');
        Route::post('users-delete-multiple', 'UsersAPIController@deleteAll');
        Route::get('users', 'UsersAPIController@index');
        Route::apiResource('users', 'UsersAPIController');
        Route::get('users-export', 'UsersAPIController@export');
/* Registration User End */
/* Country */

        Route::resource('countries', 'CountriesAPIController', [
            'only' => ['show', 'store', 'update', 'destroy']
        ]);
        Route::get('countries', 'CountriesAPIController@index');
        Route::post('countries-delete-multiple', 'CountriesAPIController@deleteAll');
        Route::get('countries-export', 'CountriesAPIController@export');
/* Country End */

/* State */

        Route::resource('states', 'StatesAPIController', [
            'only' => ['show', 'store', 'update', 'destroy']
        ]);
        Route::get('states', 'StatesAPIController@index');
        Route::post('states-delete-multiple', 'StatesAPIController@deleteAll');
        Route::get('states-export', 'StatesAPIController@export');

 /* State End */       
/* City */

        Route::resource('cities', 'CitiesAPIController', [
            'only' => ['show', 'store', 'update', 'destroy']
        ]);
        Route::get('cities', 'CitiesAPIController@index');
        Route::post('cities-delete-multiple', 'CitiesAPIController@deleteAll');
        Route::get('cities-export', 'CitiesAPIController@export');
/* City End */
/* Hobbies */

        Route::resource('hobbies', 'HobbiesAPIController', [
            'only' => ['show', 'store', 'update', 'destroy']
        ]);
        Route::get('hobbies', 'HobbiesAPIController@index');
        Route::post('hobbies-delete-multiple', 'HobbiesAPIController@deleteAll');  
        Route::get('hobbies-export', 'HobbiesAPIController@export');
/* Hobbies End */
/* Start Login */
        Route::post('login','LoginController@login');
/* End Login */



            });
        });


