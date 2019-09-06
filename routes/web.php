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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('product')->group(function () {
    Route::post('/', 'ProductController@create');
    Route::get('/', 'ProductController@get');
    Route::get('/{id}', 'ProductController@getById');

    Route::post('/{id}/detail', 'ProductDetailController@create');
    Route::get('/{id}/detail', 'ProductDetailController@get');
});

Route::prefix('transaction')->group(function () {
    Route::get('/', 'TransactionController@get');
    Route::post('/', 'TransactionController@create')->middleware('validateOrder');
});
