<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
* Snippet for a quick route reference
*/



Route::group([
    'prefix' => 'v1',
    'namespace' => 'API',
], function () {

    Route::group([
        'namespace' => 'User',
    ], function () {

        Route::post('register', 'UsersAPIController@register');

        });
});


