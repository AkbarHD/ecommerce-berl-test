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

Route::middleware('auth')->group(function () {
    Route::post('/logout',  'LoginController@logout')->name('logout');
    Route::get('/admin/homeadmin',  'HomeController@homeadmin')->name('homeadmin');
});

Route::get('/login', 'LoginController@login')->name('login');
Route::post('/login',  'LoginController@loginProses')->name('loginProses');
Route::get('/register',  'LoginController@register')->name('register');
Route::post('/register', 'LoginController@registerProses')->name('registerProses');
