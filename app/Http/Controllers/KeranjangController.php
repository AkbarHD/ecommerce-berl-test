<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class KeranjangController extends Controller
{
    public function removeItem(Request $request)
    {
        try {
            $cartId = $request->cart_id;

            // Pastikan item ada dan milik user yang sedang login
            $cartItem = DB::table('cart_temporary')
                ->where('id', $cartId)
                ->where('user_id', Auth::id())
                ->where('isdelete', '0')
                ->first();

            if (!$cartItem) {
                return response()->json([
                    'success' => false,
                    'message' => 'Item tidak ditemukan di keranjang'
                ]);
            }

            // Update isdelete menjadi 1 (soft delete)
            $updated = DB::table('cart_temporary')
                ->where('id', $cartId)
                ->where('user_id', Auth::id())
                ->update([
                    'isdelete' => '1',
                    'mby' => Auth::id(), // modified by
                    'updated_at' => now()
                ]);

            if ($updated) {
                // Hitung jumlah item yang tersisa di keranjang
                $remainingItems = DB::table('cart_temporary')
                    ->where('user_id', Auth::id())
                    ->where('isdelete', '0')
                    ->count();

                return response()->json([
                    'success' => true,
                    'message' => 'Item berhasil dihapus dari keranjang',
                    'remaining_items' => $remainingItems
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menghapus item dari keranjang'
                ]);
            }

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    // store checkout
    public function store(Request $request)
    {
        try {
            // Validasi input
            $validator = Validator::make($request->all(), [
                'nama_lengkap' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'no_hp' => 'required|string|max:30',
                'province' => 'required|string|max:255',
                'alamat' => 'required|string',
                'ekspedisi' => 'required|string|max:255',
                'ongkir' => 'required|numeric|min:0'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak valid',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Check if user is authenticated
            if (!Auth::check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'User tidak terautentikasi'
                ], 401);
            }

            DB::beginTransaction();

            // Generate invoice number
            $lastInvoice = DB::table('carts')
                ->whereYear('created_at', date('Y'))
                ->orderBy('id', 'desc')
                ->first();

            if ($lastInvoice) {
                $lastNumber = (int) substr($lastInvoice->invoice, -3);
                $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
            } else {
                $newNumber = '001';
            }

            $invoice = 'INV-' . date('Y') . '-' . $newNumber;

            // Get cart items
            $cartItems = DB::table('cart_temporary')
                ->join('products', 'products.id', '=', 'cart_temporary.product_id')
                ->leftJoin('setting_harga', function ($join) {
                    $join->on('setting_harga.product_id', '=', 'products.id')
                        ->whereDate('setting_harga.periode_awal', '<=', now())
                        ->whereDate('setting_harga.periode_akhir', '>=', now())
                        ->where('setting_harga.isdelete', '0');
                })
                ->select(
                    'cart_temporary.*',
                    'products.nama_product',
                    'products.gambar',
                    DB::raw('COALESCE(setting_harga.harga, cart_temporary.price) as harga')
                )
                ->where('cart_temporary.user_id', Auth::id())
                ->where('cart_temporary.isdelete', '0')
                ->get();

            if ($cartItems->isEmpty()) {
                DB::rollback();
                return response()->json([
                    'success' => false,
                    'message' => 'Keranjang belanja kosong'
                ], 400);
            }

            // Insert ke table carts
            $cartId = DB::table('carts')->insertGetId([
                'user_id' => Auth::id(),
                'invoice' => $invoice,
                'nama_lengkap' => $request->nama_lengkap,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'province' => $request->province,
                'alamat' => $request->alamat,
                'ekspedisi' => $request->ekspedisi,
                'ongkir' => $request->ongkir,
                'status' => 0, // 0 = pending, 1 = paid, 2 = cancelled
                'cby' => Auth::id(),
                'mby' => null,
                'isdelete' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // Check if cart was created successfully
            if (!$cartId) {
                DB::rollback();
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal membuat pesanan'
                ], 500);
            }

            // Insert ke table cart_detail
            foreach ($cartItems as $item) {
                $detailInserted = DB::table('cart_detail')->insert([
                    'cart_id' => $cartId,
                    'product_id' => $item->product_id,
                    'qty' => $item->qty,
                    'price' => $item->harga,
                    'cby' => Auth::id(),
                    'mby' => null,
                    'isdelete' => '0',
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                if (!$detailInserted) {
                    DB::rollback();
                    return response()->json([
                        'success' => false,
                        'message' => 'Gagal menyimpan detail pesanan'
                    ], 500);
                }
            }

            // Hapus items dari cart_temporary (soft delete)
            $tempCartUpdated = DB::table('cart_temporary')
                ->where('user_id', Auth::id())
                ->where('isdelete', '0')
                ->update([
                    'isdelete' => '1',
                    'updated_at' => now()
                ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Pesanan berhasil dibuat',
                'invoice' => $invoice,
                'cart_id' => $cartId
            ], 200);

        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            \Log::error('Database Query Error in checkout: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan database: ' . $e->getMessage()
            ], 500);

        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('General Error in checkout: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()
            ], 500);
        }
    }
}


