<?php

use Illuminate\Http\Request;

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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group(['prefix' => 'filter'], function () {
    Route::post('categories', [
	'uses' => 'FilterController@getCategories'
    ]);
    Route::post('sizes', [
	'uses' => 'FilterController@getSizes'
    ]);
    Route::post('materials', [
	'uses' => 'FilterController@getMaterials'
    ]);
    Route::post('types', [
	'uses' => 'FilterController@getTypes'
    ]);
    Route::post('colors', [
	'uses' => 'FilterController@getColors'
    ]);
    Route::post('bodies', [
	'uses' => 'FilterController@getBodies'
    ]);
    Route::post('borders', [
	'uses' => 'FilterController@getBorders'
    ]);
    Route::post('product', [
	'uses' => 'FilterController@getProduct'
    ]);
});
