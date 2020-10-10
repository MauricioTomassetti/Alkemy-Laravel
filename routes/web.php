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

/**
 * Rutas para la autenticacion, se utiliza la funcionalidad que brinda laravel Auth.
 */
Auth::routes();

/**
 * Rutas de inicio de la aplicacion.
 */
Route::get('/', 'HomeController@index');

/**
 * Rutas para el usuario cliente y no autenticados y evita que el usuario desarrollador tambien entre
 * por eso tambien se encuentra protegido con otro middleware.
 */
Route::group(['middleware' => ['home']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('categories/{category:slug}', 'ApplicationController@showAppNotBuyWhitCategory')->name('appcategories');
    Route::get('appDetail/{application:slug}', 'ApplicationController@show')->name('guest.appDetail');
    Route::get('list/vote', 'ApplicationController@showListWhitVote')->name('list.vote');
});

/**
 * Rutas para el usuario cliente para comprar.
 * Utiliza un prefijo de ruta api.
 */
Route::group(['prefix' => 'api'], function () {

    //Uso de Endpoint para javascript
    Route::post('buy', 'ClientController@store');
    Route::delete('cancelbuy/{id}', 'ClientController@destroy');
});

/**
 * Rutas para el usuario cliente.
 * Protegido con un Middleware para mas seguridad en las rutas.
 */
Route::group(['middleware' => ['client']], function () {
    Route::get('/me/app/{id:name}', 'ClientController@index')->name('me.client');
    Route::post('/me/app/{application:slug}', 'ApplicationController@desiredApp')->name('me.desired');
    Route::get('/me/appDetail/{application:slug}', 'ApplicationController@show')->name('me.appDetail');
    Route::get('/me/app/list/{id:name}', 'ApplicationController@showDesiredApp')->name('me.desiredList');
    Route::get('/me/app/remove/{application}', 'ApplicationController@removeDesiredApp')->name('me.remove');
});

/**
 * Rutas para el usuario desarrollador.
 * Protegido con un Middleware para mas seguridad en las rutas.
 */
Route::group(['middleware' => ['developer']], function () {
    Route::get('/me/app/{id:name}/list', 'ApplicationController@index')->name('me.list');
    Route::get('/me/app/{application:slug}/edit', 'ApplicationController@edit')->name('me.edit');
    Route::put('/me/app/{application:slug}/update', 'ApplicationController@update')->name('me.update');
    Route::get('/me/app/create/new', 'ApplicationController@create')->name('me.create');
    Route::post('/me/app/create/app', 'ApplicationController@store')->name('me.store');
    Route::get('/me/app/{application:slug}/delete', 'ApplicationController@destroy')->name('me.delete');
    Route::get('/me/categories/appDetail/{application:slug}', 'ApplicationController@show')->name('me.detail');
});
