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
    ['prefix' => 'tags', 'middleware' => ['auth', 'web']],
    function() {
        Route::get('/', 'TagsController@index')->name('Admin.Tags');
        Route::get('/create', 'TagsController@create')->name('Admin.Tags.create');
        Route::get('/edit/{tag}', 'TagsController@edit')->name('Admin.Tags.edit');
        Route::post('/store', 'TagsController@store')->name('Admin.Tags.store');
        Route::post('/update/{tag}', 'TagsController@update')->name('Admin.Tags.update');
        Route::GET('/delete/{tag}', 'TagsController@destroy')->name('Admin.Tags.delete');
    }
);
