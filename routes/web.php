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

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'filter'], function () {
    Route::get('categories', [
	'uses' => 'FilterController@getCategories'
    ]);
    Route::get('sizes', [
	'uses' => 'FilterController@getSizes'
    ]);
    Route::get('materials', [
	'uses' => 'FilterController@getMaterials'
    ]);
    Route::get('types', [
	'uses' => 'FilterController@getTypes'
    ]);
});
