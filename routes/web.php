<?php

use App\Application;
use App\Category;
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

//Rutas de Authenticacion
Auth::routes();

//Ruta para el uso de categorias de un usuario no autenticado
Route::get(
    'applications/{applications}category/{categories:slug}',
    'ApplicationController@show'
)->name('appcategories');

Route::get('/categories', 'CategoryController@index')->name('searchcategory');

//Ruta para ver los detalles de esa applicacion(Visitante y usuarios Authenticados)
Route::get('/me/categories/appDetail/{name:slug}', 'ApplicationController@showapp')->name('appDetail');

Route::group(['prefix' => 'api'], function () {
    //Uso de Endpoint para javascript
    Route::post('buy', 'ClientController@store');
    Route::delete('cancelbuy/{id}', 'ClientController@destroy');
});

Route::group(['middleware' => ['client']], function () {
    //Ruta para ver las aplicaciones que compre
    Route::get('/me/client/{id:slug}', 'ClientController@index')->name('/me/client');
});

Route::group(['middleware' => ['developer']], function () {
    //Ruta para el Apartado Desarrollador
    Route::get('/me/my-list-app/{id:slug}', 'ApplicationController@index')->name('/me/myListApp');

    //Ruta para las Applicaciones
    Route::resource('/me/app', 'ApplicationController', ['except' => ['index', 'update', 'edit']]);
});
Route::group(['middleware' => ['category']], function () {
    //Ruta de listar las categorias
    Route::get('/me/categories', 'CategoryController@index')->name('listCategory');
    //Ruta para mostrar las aplicaciones de una categoria
    Route::get('/me/categories/{id:slug}', 'ApplicationController@show')->name('appCategory');
});

Route::get('/home', 'HomeController@index')->name('home');

// Route::namespace('Admin')->prefix('admin')->name('admin')->group(function(){
//Route::resource('/user', 'UserController',['except'=>['show','create','store']]);
//});
