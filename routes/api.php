<?php

Route::group(['prefix' => 'v1','namespace' => 'API',], function () {

    Route::group(['namespace' => 'User',], function () {

/* Registration User*/

        Route::post('register', 'UsersAPIController@register');
        Route::post('users/{user}', 'UsersAPIController@update');
        //Route::post('users-delete/{id}', 'UsersAPIController@destroy');

        Route::post('users-delete-multiple', 'UsersAPIController@deleteAll');
/* Registration User End */
/* Country */

        Route::resource('countries', 'CountriesAPIController', [
            'only' => ['show', 'store', 'update', 'destroy']
        ]);
        Route::get('countries', 'CountriesAPIController@index');
        Route::post('countries-delete-multiple', 'CountriesAPIController@deleteAll');

/* Country End */

/* State */

        Route::resource('states', 'StatesAPIController', [
            'only' => ['show', 'store', 'update', 'destroy']
        ]);
        Route::get('states', 'StatesAPIController@index');
        Route::post('states-delete-multiple', 'StatesAPIController@deleteAll');

 /* State End */       
/* City */

        Route::resource('cities', 'CitiesAPIController', [
            'only' => ['show', 'store', 'update', 'destroy']
        ]);
        Route::get('cities', 'CitiesAPIController@index');
        Route::post('cities-delete-multiple', 'CitiesAPIController@deleteAll');

/* City End */
/* Hobbies */
        Route::resource('hobbies', 'HobbiesAPIController', [
            'only' => ['show', 'store', 'update', 'destroy']
        ]);
        Route::post('hobbies-delete-multiple', 'HobbiesAPIController@deleteAll');      
/* Hobbies End */




            });
        });


