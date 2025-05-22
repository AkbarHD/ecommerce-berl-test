<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        return view('frontend.beranda');
    }

    public function product()
    {
        return view('frontend.product');
    }

    public function keranjang()
    {
        return view('frontend.keranjang');
    }

    public function checkout()
    {
        return view('frontend.checkout');
    }

    public function transaksi()
    {
        return view('frontend.transaksi');
    }
}
