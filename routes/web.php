<?php

use App\Application;
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
    return redirect('home');
});

Auth::routes();

// Route::group(['middleware' => ['client']], function () {
Route::get('/me/client/{id}', 'ClientController@index')->name('/me/client');
Route::get('/me/categories', 'CategoryController@index')->name('listCategory');
Route::get('/me/categories/{id:slug}', 'CategoryController@show')->name('appCategory');
Route::get('/me/appDetail/{id:slug}', 'CategoryController@showapp')->name('appDetail');


Route::group(['prefix' => 'api'], function () {
    Route::post('buy', 'ClientController@store');
    Route::delete('cancelbuy/{id}', 'ClientController@destroy');
});
// });



Route::group(['middleware' => ['developer']], function () {
    //Route::get('/me/developer', 'DeveloperController@index')->name('/me/developer');

    //Ruta para las Applicaciones
    Route::resource('/me/app', 'ApplicationController');

    //Ruta para el Apartado Desarrollador
    Route::get('/me/my-list-app/{id}', 'DeveloperController@index')->name('myListApp');
});

Route::get('/home', 'HomeController@index')->name('home');
// Route::namespace('Admin')->prefix('admin')->name('admin')->group(function(){
    //Route::resource('/user', 'UserController',['except'=>['show','create','store']]);
//});
