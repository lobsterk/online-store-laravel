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

Route::namespace('Admin')->prefix('admin')->middleware('admin')->group(function () {
    route::view('/', 'admin.main');
    route::resource('/client', 'Clients\ClientsController')->only(['index']);
    route::resource('/manufacturer', 'Manufacturers\ManufacturersController')->except(['show', 'edit', 'create']);
    route::resource('/category', 'Categories\CategoryController')->except(['show', 'edit', 'create']);
    route::get('/category/all', 'Categories\CategoryController@getCategories')->name('category.get_all');
    route::resource('/product', 'Products\ProductController')->except(['show', 'edit', 'create']);
    route::get('product/get/status', 'Products\ProductController@getProductStatus')->name('product.get.status');
    route::get('product/get/item/{id}', 'Products\ProductController@getItem')->name('product.get.item');
});