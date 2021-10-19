<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'v1', 'namespace' => 'API',], function () {

        Route::group(['namespace' => 'User',], function () {

                Route::get('email/verify/{id}', 'VerificationAPIController@verify')->name('verification.verify');
                Route::get('email/resend', 'VerificationAPIController@resend')->name('verification.resend');
                Route::post('forgot-passsword', 'ForgotPasswordAPIController@sendResetLinkEmail');

                /*Starts Registration User*/
                Route::post('register', 'UsersAPIController@register');
                /*End Registration User  */
                /* Start Country */
                Route::get('countries', 'CountriesAPIController@index');
                /* End Country */
                /* State */
                Route::get('states', 'StatesAPIController@index');
                /* State End */
                /* City */
                Route::get('cities', 'CitiesAPIController@index');
                /* End City  */
                /* Hobbies */
                Route::get('hobbies', 'HobbiesAPIController@index');
                /*End Hobbies  */
                /* Start Login */
                Route::post('login', 'LoginController@login');
                /* End Login */


                Route::post('change-password', 'LoginController@changePassword');
                /* Start Authorization */
                Route::group([
                        'middleware' => ['auth:api', 'check.permission'],
                ], function () {

                        /* Start Permisssion User */
                        Route::post('users/{user}', 'UsersAPIController@update');
                        Route::post('users-delete/{user}', 'UsersAPIController@destroy');
                        Route::post('users-delete-multiple', 'UsersAPIController@deleteAll');
                        Route::get('users', 'UsersAPIController@index');
                        Route::apiResource('users', 'UsersAPIController');
                        Route::get('users-export', 'UsersAPIController@export');
                        Route::post('users-import-bulk', 'UsersAPIController@importBulk');
                        /* End Permisssion User */
                        /*Start Permisssion Country */
                        Route::resource('countries', 'CountriesAPIController', [
                                'only' => ['show', 'store', 'update', 'destroy']
                        ]);
                        Route::post('countries-delete-multiple', 'CountriesAPIController@deleteAll');
                        Route::get('countries-export', 'CountriesAPIController@export');
                        Route::post('countries-import-bulk', 'CountriesAPIController@importBulk');
                        /*End Permisssion Country End */
                        /* Start Permission State */
                        Route::resource('states', 'StatesAPIController', [
                                'only' => ['show', 'store', 'update', 'destroy']
                        ]);
                        Route::post('states-delete-multiple', 'StatesAPIController@deleteAll');
                        Route::get('states-export', 'StatesAPIController@export');
                        Route::post('states-import-bulk', 'StatesAPIController@importBulk');
                        /* End Permission State */
                        /* Start Permisssion Cities */
                        Route::resource('cities', 'CitiesAPIController', [
                                'only' => ['show', 'store', 'update', 'destroy']
                        ]);
                        Route::post('cities-delete-multiple', 'CitiesAPIController@deleteAll');
                        Route::get('cities-export', 'CitiesAPIController@export');
                        Route::post('cities-import-bulk', 'CitiesAPIController@importBulk');

                        /* Start Delete Gallery */
                        Route::delete('gallery/{gallery}', 'UsersAPIController@delete_gallery');
                        /* End Delete Gallery */

                        /* Start Permisison  */
                        Route::apiResource('permissions', 'PermissionsAPIController');
                        Route::post('permissions-delete-multiple', 'PermissionsAPIController@deleteAll');
                        Route::post('set_unset_permission_to_role', 'PermissionsAPIController@setUnsetPermissionToRole');
                        Route::get('permissions-export', 'PermissionsAPIController@export');
                        /* End Permisison  */
                        /* Start Permission Roles */
                        Route::apiResource('roles', 'RolesAPIController');
                        Route::post('roles-delete-multiple', 'RolesAPIController@deleteAll');
                        Route::get('roles-export', 'RolesAPIController@export');
                        Route::get('get_role_by_permissions/{id}', 'RolesAPIController@getPermissionsByRole');
                        /* End Permission Roles */
                        /* Start Permission Hobbies */
                        Route::resource('hobbies', 'HobbiesAPIController', [
                                'only' => ['show', 'store', 'update', 'destroy']
                        ]);
                        Route::post('hobbies-delete-multiple', 'HobbiesAPIController@deleteAll');
                        Route::get('hobbies-export', 'HobbiesAPIController@export');
                        Route::post('hobbies-import-bulk', 'HobbiesAPIController@importBulk');
                        /* End Permission Hobbies */
                        /* Start Permission Logout */
                        Route::get('logout', 'LoginController@logout');

                        /* End Permission Logout */
                });
                /* End Authorization */
        });
});
