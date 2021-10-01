<?php

Route::group(['prefix' => 'v1','namespace' => 'API',], function () {

    Route::group(['namespace' => 'User',], function () {

        Route::post('register', 'UsersAPIController@register');
        Route::get('batch_request', 'UsersAPIController@batchRequest');
        Route::post('login','LoginController@login');
        });
});


