<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $cartItems = DB::table('cart_temporary')
                    ->join('products', 'cart_temporary.product_id', '=', 'products.id')
                    ->join('setting_harga', 'products.id', '=', 'setting_harga.product_id')
                    ->select('products.*', 'cart_temporary.*', 'setting_harga.harga')
                    ->where('cart_temporary.user_id', Auth::id())
                    ->where('cart_temporary.isdelete', 0)
                    ->get();

                $view->with('globalCartItems', $cartItems);
            }
        });
    }
}
