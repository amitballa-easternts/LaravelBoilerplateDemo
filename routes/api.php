<?php

Route::group(['prefix' => 'v1','namespace' => 'API',], function () {

    Route::group(['namespace' => 'User',], function () {

/* Registration */
        Route::post('register', 'UsersAPIController@register');

        //Route::get('batch_request', 'UsersAPIController@batchRequest');
        Route::post('login','LoginController@login');
/* Country */
        Route::resource('countries', 'CountriesAPIController', [
            'only' => ['show', 'store', 'update', 'destroy']
        ]);
        Route::get('countries', 'CountriesAPIController@index');
        Route::post('countries-delete-multiple', 'CountriesAPIController@deleteAll');

/* State */

        Route::resource('states', 'StatesAPIController', [
            'only' => ['show', 'store', 'update', 'destroy']
        ]);
        Route::get('states', 'StatesAPIController@index');

        });
        Route::post('states-delete-multiple', 'StatesAPIController@deleteAll');
        
});


