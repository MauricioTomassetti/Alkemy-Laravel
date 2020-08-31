<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


Route::group(['middleware' => ['client']], function () {
    Route::get('/me/client', 'ClientController@index')->name('/me/client');
    Route::get('/me/categories', 'CategoryController@index')->name('listCategory');
    Route::get('/me/categories/{category}', 'CategoryController@show')->name('appCategory');
    Route::get('/me/appDetail/{application}', 'CategoryController@showapp')->name('appDetail');
    Route::post('/me/purcharsed', 'PurcharseController@index')->name('purcharsed');
});


Route::group(['middleware' => ['developer']], function () {

    Route::post('/me/listApp', 'ApplicationController@index')->name('listAppDeveloper');
    Route::post('/me/app', 'ApplicationController@store');
    Route::get('/me/app/{application}', 'ApplicationController@show');
    Route::put('/me/app/{application}', 'ApplicationController@update');
    Route::delete('/me/app/{application}', 'ApplicationController@destroy');

    Route::get('/me/developer', 'DeveloperController@index')->name('/me/developer');
});

Route::get('/home', 'HomeController@index')->name('home');
// Route::namespace('Admin')->prefix('admin')->name('admin')->group(function(){
    //Route::resource('/user', 'UserController',['except'=>['show','create','store']]);
//});
