<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
Route::get('/products/{id}', 'FrontController@detail')->name('products.detail');



Route::middleware('auth')->group(function () {
    Route::post('/logout', 'LoginController@logout')->name('logout');
    Route::get('/admin/homeadmin', 'HomeController@homeadmin')->name('homeadmin');

    Route::get('/profile', 'HomeController@profile')->name('profile');
    Route::put('/profile/update', 'HomeController@updateProfile')->name('profile.update');

    // add to card
    Route::post('/cart/add', 'CartController@addToCart')->name('cart.add');
    Route::get('/keranjang', 'FrontController@keranjang')->name('keranjang');
    Route::post('/keranjang/remove-item', 'KeranjangController@removeItem')->name('keranjang.remove');

    //heckout
    Route::get('/checkout', 'FrontController@checkout')->name('checkout');
    Route::post('/checkout/process', 'KeranjangController@store')->name('checkout.store');
    Route::get('/api/provinces', 'KeranjangController@getProvinces')->name('api.provinces');

    Route::get('/transaksi', 'FrontController@transaksi')->name('transaksi');
    Route::get('/transaksi/detail/{id}', 'FrontController@getTransactionDetail')->name('transaksi.detail');
    Route::post('/transaksi/batal/{id}', 'FrontController@cancelTransaction')->name('transaksi.cancel');
    Route::post('/transaksi/pay/{id}', 'FrontController@payWithMidtrans')->name('transaksi.pay');
    // Route::post('/transaksi/update-status', 'FrontController@updateStatus')->name('transaksi.updateStatus');


    // cart
    Route::get('/cart/count', function () {
        if (Auth::check()) {
            $count = DB::table('cart_temporary')
                ->where('user_id', Auth::id())
                ->where('isdelete', 0)
                ->count();
            return response()->json(['count' => $count]);
        }
        return response()->json(['count' => 0]);
    })->name('cart.count');


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

      Route::get('/profile/admin', 'HomeController@editProfileAdmin')->name('profile.admin');

    Route::get('/transaksi-masuk', 'HomeController@transaksi')->name('transaksi.in');
    Route::get('/admin/transaksi/{id}', 'HomeController@showTransaksi')->name('admin.transaksi.detail');
});

Route::get('/login', 'LoginController@login')->name('login');
Route::post('/login', 'LoginController@loginProses')->name('loginProses');
Route::get('/register', 'LoginController@register')->name('register');
Route::post('/register', 'LoginController@registerProses')->name('registerProses');
