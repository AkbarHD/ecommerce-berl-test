<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    public function index()
    {
        $today = Carbon::now()->format('Y-m-d');

        $products = DB::table('setting_harga')
            ->join('products', 'products.id', '=', 'setting_harga.product_id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('setting_harga.*', 'products.nama_product', 'products.gambar', 'products.id',  'categories.name')
            ->where('setting_harga.periode_awal', '<=', $today)
            ->where('setting_harga.periode_akhir', '>=', $today)
            ->orderBy('setting_harga.periode_awal', 'asc')
            ->where('products.isdelete', 0)
            ->where('setting_harga.isdelete', 0)
            ->where('categories.isdelete', 0)
            ->limit(8)
            ->get();
        return view('frontend.beranda', compact('products'));
    }

    public function product(Request $request)
    {
        $today = Carbon::now()->format('Y-m-d');

        $query = DB::table('setting_harga')
            ->join('products', 'products.id', '=', 'setting_harga.product_id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('setting_harga.*', 'products.nama_product', 'products.gambar', 'products.id', 'categories.name')
            ->where('setting_harga.periode_awal', '<=', $today)
            ->where('setting_harga.periode_akhir', '>=', $today)
            ->where('products.isdelete', 0)
            ->where('setting_harga.isdelete', 0)
            ->where('categories.isdelete', 0);

        // Pencarian nama produk
        if ($request->filled('search')) {
            $query->where('products.nama_product', 'like', '%' . $request->search . '%');
        }

        // Filter kategori (jika lebih dari 1 pakai whereIn)
        if ($request->filled('category')) {
            $query->whereIn('categories.name', (array) $request->category);
        }

        $products = $query->orderBy('setting_harga.periode_awal', 'asc')
            ->paginate(2)
            ->appends($request->all()); // agar parameter pencarian ikut di pagination

        $categories = DB::table('categories')
            ->where('isdelete', 0)
            ->get();

        return view('frontend.product', compact('products', 'categories'));
    }

    public function detail($id)
    {
        $today = Carbon::now()->format('Y-m-d');

        $product = DB::table('setting_harga')
            ->join('products', 'products.id', '=', 'setting_harga.product_id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('setting_harga.*', 'products.nama_product', 'products.gambar', 'products.id', 'products.keterangan', 'categories.name')
            ->where('setting_harga.periode_awal', '<=', $today)
            ->where('setting_harga.periode_akhir', '>=', $today)
            ->orderBy('setting_harga.periode_awal', 'asc')
            ->where('products.isdelete', 0)
            ->where('setting_harga.isdelete', 0)
            ->where('categories.isdelete', 0)
            ->where('products.id', $id)
            ->first();

        return view('frontend.detail_product', compact('product'));
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
