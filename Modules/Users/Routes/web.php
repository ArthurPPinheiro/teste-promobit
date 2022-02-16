<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(
    ['prefix' => 'users', 'middleware' => ['auth', 'web']],
    function() {
        Route::get('/', 'UsersController@index')->name('Admin.Users');
        Route::get('/create', 'UsersController@create')->name('Admin.Users.create');
        Route::get('/edit/{user}', 'UsersController@edit')->name('Admin.Users.edit');
        Route::post('/store', 'UsersController@store')->name('Admin.Users.store');
        Route::post('/update/{user}', 'UsersController@update')->name('Admin.Users.update');
        Route::GET('/delete/{user}', 'UsersController@destroy')->name('Admin.Users.delete');
    }
);

Route::group(
    ['prefix' => 'roles', 'middleware' => ['auth', 'web']],
    function() {
        Route::GET('/', 'RolesController@index')->name('Admin.Roles');
        Route::GET('/create', 'RolesController@create')->name('Admin.Roles.create');
        Route::GET('/edit/{role}', 'RolesController@edit')->name('Admin.Roles.edit');
        Route::POST('/store', 'RolesController@store')->name('Admin.Roles.store');
        Route::POST('/update/{role}', 'RolesController@update')->name('Admin.Roles.update');
        Route::GET('/delete/{role}', 'RolesController@destroy')->name('Admin.Roles.delete');
    }
);
