<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function homeadmin()
    {
        $totalPending = DB::table('carts')->where('status', 0)->count();
        $totalLunas = DB::table('carts')->where('status', 1)->count();
        $totalBatal = DB::table('carts')->where('status', 2)->count();

        return view('admin.homeadmin', compact('totalPending', 'totalLunas', 'totalBatal'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('frontend.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:users,email,' . $user->id,
            'no_hp' => 'required|string|max:20',
            'gender' => 'required|in:male,female',
            'alamat' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // max 2MB
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle image upload
        $logoPath = $user->logo;
        if ($request->hasFile('logo')) {
            // Delete old photo if exists
            if ($user->logo && File::exists(public_path($user->logo))) {
                File::delete(public_path($user->logo));
            }

            $file = $request->file('logo');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/logo'), $filename);
            $logoPath = 'uploads/logo/' . $filename;
        }

        DB::table('users')->where('id', $user->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'gender' => $request->gender,
            'alamat' => $request->alamat,
            'logo' => $logoPath,
            'updated_at' => now(),
        ]);

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }

    public function transaksi()
    {
        $transactions = DB::table('carts')
            ->orderBy('created_at', 'desc')
            ->where('isdelete', 0)
            ->get();

        return view('admin.transaksi.index', compact('transactions'));
    }

    public function showTransaksi($id)
    {
        // Ambil transaksi dan data user
        $transaction = DB::table('carts')
            ->join('users', 'users.id', '=', 'carts.user_id')
            ->select('carts.*', 'users.name as user_name')
            ->where('carts.id', $id)
            ->first();

        // Ambil detail item dan join dengan produk
        $details = DB::table('cart_detail')
            ->join('products', 'products.id', '=', 'cart_detail.product_id')
            ->select('cart_detail.*', 'products.nama_product')
            ->where('cart_detail.cart_id', $id)
            ->where('cart_detail.isdelete', '0')
            ->get();

        return view('admin.transaksi.detail', compact('transaction', 'details'));
    }

    public function editProfileAdmin()
    {
         $user = Auth::user();
         return view('admin.profile.index', compact('user'));
    }


}
