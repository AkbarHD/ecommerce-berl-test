<?php

namespace App\Http\Controllers;

use \Log;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;
use Midtrans\Snap;

class FrontController extends Controller
{
    public function index()
    {
        $today = Carbon::now()->format('Y-m-d');

        $products = DB::table('setting_harga')
            ->join('products', 'products.id', '=', 'setting_harga.product_id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('setting_harga.*', 'products.nama_product', 'products.gambar', 'products.id', 'categories.name')
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
            ->paginate(6)
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
            ->where('cart_temporary.isdelete', 0)
            ->get();
        // $countCart = DB::table('cart_temporay')->where('user_id', Auth::user()->id)->where('isdelete', 0)->count();
        return view('frontend.keranjang', compact('cartItems'));
    }

    public function checkout()
    {
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
            ->where('cart_temporary.isdelete', 0)
            ->get();

        // Mengambil semua provinsi dengan nama sebagai key dan value
        $provinces = DB::table('tb_ro_provinces')->pluck('province_name', 'province_name');
        return view('frontend.checkout', compact('cartItems', 'provinces'));
    }

    private function getStatusText($status)
    {
        switch ($status) {
            case 0:
                return 'Menunggu Pembayaran';
            case 1:
                return 'Lunas';
            case 2:
                return 'Dibatalkan';
            default:
                return 'Status Tidak Dikenal';
        }
    }

    private function getStatusClass($status)
    {
        switch ($status) {
            case 0:
                return 'status-pending';
            case 1:
                return 'status-paid';
            case 2:
                return 'status-cancelled';
            default:
                return 'status-pending';
        }
    }

    public function transaksi(Request $request)
    {
        $query = DB::table('carts')
            ->join('users', 'users.id', '=', 'carts.user_id')
            ->select(
                'carts.*',
                'users.name as user_name'
            )
            ->where('carts.user_id', Auth::id())
            ->where('carts.isdelete', '0')
            ->orderBy('carts.created_at', 'desc');

        // Filter by status if provided
        if ($request->has('status') && $request->status != '') {
            $statusMap = [
                'pending' => 0,
                'paid' => 1,
                'cancelled' => 2
            ];

            if (isset($statusMap[$request->status])) {
                $query->where('carts.status', $statusMap[$request->status]);
            }
        }

        $transactions = $query->paginate(3);

        // Get transaction details for each transaction
        foreach ($transactions as $transaction) {
            $transaction->details = DB::table('cart_detail')
                ->join('products', 'products.id', '=', 'cart_detail.product_id')
                ->select(
                    'cart_detail.*',
                    'products.nama_product',
                    'products.gambar'
                )
                ->where('cart_detail.cart_id', $transaction->id)
                ->where('cart_detail.isdelete', '0')
                ->get();

            // Calculate subtotal
            $transaction->subtotal = $transaction->details->sum(function ($detail) {
                return $detail->qty * $detail->price;
            });

            // Calculate grand total
            $transaction->grand_total = $transaction->subtotal + $transaction->ongkir;

            // Format status
            $transaction->status_text = $this->getStatusText($transaction->status);
            $transaction->status_class = $this->getStatusClass($transaction->status);
        }
        return view('frontend.transaksi', compact('transactions'));
    }

    public function getTransactionDetail($id)
    {
        $transaction = DB::table('carts')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->where('isdelete', '0')
            ->first();

        if (!$transaction) {
            return response()->json(['error' => 'Transaksi tidak ditemukan'], 404);
        }

        $details = DB::table('cart_detail')
            ->join('products', 'products.id', '=', 'cart_detail.product_id')
            ->select('cart_detail.*', 'products.nama_product', 'products.gambar')
            ->where('cart_detail.cart_id', $transaction->id)
            ->where('cart_detail.isdelete', '0')
            ->get();

        $subtotal = $details->sum(function ($d) {
            return $d->qty * $d->price;
        });

        $transaction->details = $details;
        $transaction->subtotal = $subtotal;
        $transaction->grand_total = $subtotal + $transaction->ongkir;
        $transaction->status_text = $this->getStatusText($transaction->status);
        $transaction->status_class = $this->getStatusClass($transaction->status);

        return response()->json(['transaction' => $transaction]);
    }

    public function cancelTransaction($id)
    {
        $transaction = DB::table('carts')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->where('isdelete', '0')
            ->where('status', 0) // hanya yang masih pending bisa dibatalkan
            ->first();

        if (!$transaction) {
            return response()->json(['error' => 'Transaksi tidak ditemukan atau tidak bisa dibatalkan'], 404);
        }

        DB::table('carts')->where('id', $id)->update(['status' => 2]);

        return response()->json(['success' => 'Pesanan berhasil dibatalkan']);
    }

    public function payWithMidtrans($id)
    {
        $transaction = DB::table('carts')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->where('status', 0)
            ->first();

        if (!$transaction) {
            return response()->json(['error' => 'Transaksi tidak valid'], 404);
        }

        // Ambil detail item untuk hitung total
        $details = DB::table('cart_detail')
            ->where('cart_id', $transaction->id)
            ->where('isdelete', '0')
            ->get();

        $subtotal = $details->sum(function ($detail) {
            return $detail->qty * $detail->price;
        });

        $grandTotal = $subtotal + $transaction->ongkir;

        // Setup Midtrans
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $transaction->invoice,
                'gross_amount' => (int) $grandTotal,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            return response()->json(['snap_token' => $snapToken]);
        } catch (\Exception $e) {
            \Log::error('Midtrans Error: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal membuat Snap Token.'], 500);
        }
    }


}
