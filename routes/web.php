<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'FrontController@index')->name('home');
Route::get('/products', 'FrontController@product')->name('products');
Route::get('/product/{id}', 'FrontController@detail')->name('products.detail');
Route::get('/keranjang', 'FrontController@keranjang')->name('keranjang');
Route::get('/checkout', 'FrontController@checkout')->name('checkout');
Route::get('/transaksi', 'FrontController@transaksi')->name('transaksi');

Route::middleware('auth')->group(function () {
    Route::post('/logout',  'LoginController@logout')->name('logout');
    Route::get('/admin/homeadmin',  'HomeController@homeadmin')->name('homeadmin');

    // category
    Route::prefix('category')->group(function () {
        Route::get('/', 'CategoryController@index')->name('category.index');
        Route::post('/store', 'CategoryController@store')->name('category.store');
        Route::get('/edit', 'CategoryController@edit')->name('category.edit');
        Route::post('/update/{id}', 'CategoryController@update')->name('category.update');
        Route::delete('/delete/{id}', 'CategoryController@destroy')->name('category.destroy');
    });

    Route::prefix('product')->group(function () {
        Route::get('/', 'ProductController@index')->name('product.index');
        Route::get('/create', 'ProductController@create')->name('product.create');
        Route::post('/store', 'ProductController@store')->name('product.store');
        Route::get('/edit', 'ProductController@edit')->name('product.edit');
        Route::post('/update/{id}', 'ProductController@update')->name('product.update');
        Route::delete('/delete/{id}', 'ProductController@destroy')->name('product.destroy');
    });

    Route::prefix('setting_harga')->group(function () {
        Route::get('/', 'SettingHargaController@index')->name('setting_harga.index');
        Route::get('/create', 'SettingHargaController@create')->name('setting_harga.create');
        Route::post('/store', 'SettingHargaController@store')->name('setting_harga.store');
        Route::get('/edit', 'SettingHargaController@edit')->name('setting_harga.edit');
        Route::post('/update/{id}', 'SettingHargaController@update')->name('setting_harga.update');
        Route::delete('/delete/{id}', 'SettingHargaController@destroy')->name('setting_harga.destroy');
    });
});

Route::get('/login', 'LoginController@login')->name('login');
Route::post('/login',  'LoginController@loginProses')->name('loginProses');
Route::get('/register',  'LoginController@register')->name('register');
Route::post('/register', 'LoginController@registerProses')->name('registerProses');
