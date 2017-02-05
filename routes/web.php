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

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

//Route::get('/home', 'HomeController@index');

Route::group(
	[
	    'prefix' => LaravelLocalization::setLocale(),
	    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect']
	], function() {
    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP * */
    Route::get('/', function() {
	return view('welcome');
    });

    Route::get('home', 'HomeController@index');
    
});
