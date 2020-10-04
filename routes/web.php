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

//Rutas home
Route::get('/', function () {
    return redirect('home');
});

Route::get('/home', 'HomeController@index')->name('home');

//Rutas de Authenticacion
Auth::routes();

//Ruta para ver todos los productos segun su categoria para usuarios no autenticados.
Route::get('categories/{category:slug}', 'ApplicationController@show')->name('appcategories');

//Ruta para mostrar las aplicaciones de una categoria para usuarios autenticados.
Route::get('/me/categories/{category:slug}', 'ApplicationController@show')->name('appCategory');

// //Ruta para ver los detalles de esa applicacion(Visitante y usuarios Authenticados)
Route::get('/me/categories/appDetail/{name:slug}', 'ApplicationController@showapp')->name('appDetail');

Route::group(['prefix' => 'api'], function () {
    //Uso de Endpoint para javascript
    Route::post('buy', 'ClientController@store');
    Route::delete('cancelbuy/{id}', 'ClientController@destroy');
});

Route::group(['middleware' => ['client']], function () {
    //Ruta para ver las aplicaciones que compre.
    Route::get('/me/client/{id:slug}', 'ClientController@index')->name('me.client');
});

Route::group(['middleware' => ['developer']], function () {
    //Ruta para el Apartado Desarrollador.
    Route::get('/me/app/{id:slug}/list', 'ApplicationController@index')->name('me.list');
    Route::get('/me/app/{application:slug}/edit', 'ApplicationController@edit')->name('me.edit');
    Route::put('/me/app/{application:slug}', 'ApplicationController@update')->name('me.update');
    Route::get('/me/app/create', 'ApplicationController@create')->name('me.create');
    Route::post('/me/app/store', 'ApplicationController@store')->name('me.store');
    //Ruta para las Applicaciones
    //Route::resource('/me/app', 'ApplicationController', ['except' => ['index']]);
});

// DB::listen(function($e){
//     dump($e->sql);
// });

// Route::namespace('Admin')->prefix('admin')->name('admin')->group(function(){
//Route::resource('/user', 'UserController',['except'=>['show','create','store']]);
//});
