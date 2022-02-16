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
    ['prefix' => 'products', 'middleware' => ['auth', 'web']],
    function() {
        Route::get('/', 'ProductsController@index')->name('Admin.Products');
        Route::get('/create', 'ProductsController@create')->name('Admin.Products.create');
        Route::get('/edit/{product}', 'ProductsController@edit')->name('Admin.Products.edit');
        Route::post('/store', 'ProductsController@store')->name('Admin.Products.store');
        Route::post('/update/{product}', 'ProductsController@update')->name('Admin.Products.update');
        Route::GET('/delete/{product}', 'ProductsController@destroy')->name('Admin.Products.delete');
    }
);
