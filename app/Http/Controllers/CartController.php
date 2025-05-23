<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $userId = Auth::id();
        $productId = $request->product_id;
        $qty = $request->qty;
        $price = $request->price;

        $existing = DB::table('cart_temporary')
            ->where('product_id', $productId)
            ->where('user_id', $userId)
            ->where('isdelete', 0)
            ->first();

        if ($existing) {
            DB::table('cart_temporary')
                ->where('id', $existing->id)
                ->update([
                    'qty' => $existing->qty + $qty,
                    'mby' => Auth::user()->id,
                    'updated_at' => now(),
                ]);
        } else {
            DB::table('cart_temporary')->insert([
                'product_id' => $productId,
                'user_id' => $userId,
                'qty' => $qty,
                'price' => $price,
                'cby' => Auth::user()->id,
                'created_at' => now(),
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Produk berhasil ditambahkan ke keranjang']);
    }
}
