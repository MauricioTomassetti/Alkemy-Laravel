<?php

use Illuminate\Support\Facades\DB;
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



//Rutas de Authenticacion
Auth::routes();

Route::group(['middleware' => ['home']], function () {

    //Rutas home
    Route::get('/', function () {
        return redirect('home');
    });

    Route::get('/home', 'HomeController@index')->name('home');

    //Ruta para ver todos los productos segun su categoria para usuarios no autenticados.
    Route::get('categories/{category:slug}', 'ApplicationController@showAppNotBuyWhitCategory')->name('guest.appcategories');

    //Ruta para mostrar las aplicaciones de una categoria para usuarios autenticados.
    Route::get('/me/categories/{category:slug}', 'ApplicationController@showAppNotBuyWhitCategory')->name('appCategory');

    //Ruta para ver los detalles de esa applicacion usuarios no autenticados.
    Route::get('categories/appDetail/{application:slug}', 'ApplicationController@show')->name('guest.appDetail');

    //Ruta para ver los detalles de esa applicacion para usuarios Authenticados
    Route::get('/me/categories/appDetail/{application:slug}', 'ApplicationController@show')->name('appDetail');

    //Ruta para ver los detalles de esa applicacion para usuarios Authenticados
    Route::get('/list/vote', 'ApplicationController@showListWhitVote')->name('list.vote');
});

Route::group(['prefix' => 'api'], function () {
    //Uso de Endpoint para javascript
    Route::post('buy', 'ClientController@store');
    Route::delete('cancelbuy/{id}', 'ClientController@destroy');
});
Route::group(['middleware' => ['client']], function () {
    //Ruta para ver las aplicaciones que compre.
    Route::get('/me/app/{id:name}', 'ClientController@index')->name('me.client');
});

Route::group(['middleware' => ['developer']], function () {

    //Ruta para el Apartado Desarrollador.
    Route::get('/me/app/{id:name}/list', 'ApplicationController@index')->name('me.list');
    Route::get('/me/app/{application:slug}/edit', 'ApplicationController@edit')->name('me.edit');
    Route::put('/me/app/{application:slug}/update', 'ApplicationController@update')->name('me.update');
    Route::get('/me/app/create/new', 'ApplicationController@create')->name('me.create');
    Route::post('/me/app/store', 'ApplicationController@store')->name('me.store');
    Route::get('/me/app/{application:slug}/delete', 'ApplicationController@destroy')->name('me.delete');
});

// DB::listen(function($e){
//     dump($e->sql);
// });
