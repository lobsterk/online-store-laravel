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

Auth::routes();


Route::get('/', 'HomeController@index')->name('home');

Route::namespace('Admin')->prefix('admin')->group(function () {
    route::view('/', 'admin.main');
    route::resource('/client', 'Clients\ClientsController')->only(['index']);
    route::resource('/manufacturer', 'Manufacturers\ManufacturersController')->except(['show', 'edit', 'create']);
    route::resource('/category', 'Categories\CategoryController')->except(['show', 'edit', 'create']);
});