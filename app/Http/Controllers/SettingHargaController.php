<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingHargaController extends Controller
{
    public function index()
    {
        $setting_harga = DB::table('setting_harga')
        ->join('products', 'setting_harga.product_id', '=', 'products.id')
        ->select('setting_harga.*', 'products.nama_product')
        ->where('setting_harga.isdelete', 0)
        ->get();
        $products = DB::table('products')->where('isdelete', 0)->get();
        return view('admin.setting_harga.index', compact('setting_harga', 'products'));
    }
}
