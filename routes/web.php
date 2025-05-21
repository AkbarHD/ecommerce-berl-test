<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\LoginController;
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
Route::get('/product', 'FrontController@product')->name('product');
Route::get('/keranjang', 'FrontController@keranjang')->name('keranjang');

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
});

Route::get('/login', 'LoginController@login')->name('login');
Route::post('/login',  'LoginController@loginProses')->name('loginProses');
Route::get('/register',  'LoginController@register')->name('register');
Route::post('/register', 'LoginController@registerProses')->name('registerProses');
