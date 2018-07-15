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

Route::middleware(['admin', 'auth'])->namespace('Admin')->group(function () {
    route::view('/admin', 'admin.main');
    route::get('/admin/clients/', 'Clients\ClientsController@index')->name('admin.clients');
});