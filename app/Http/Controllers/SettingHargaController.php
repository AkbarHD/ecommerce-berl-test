<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'harga' => 'required|numeric|min:0',
                'periode_awal' => 'required|date_format:d-m-Y',
                'periode_akhir' => 'required|date_format:d-m-Y|after_or_equal:periode_awal',
            ]);

            DB::table('setting_harga')->insert([
                'product_id' => $request->product_id,
                'harga' => $request->harga,
                'periode_awal' => Carbon::createFromFormat('d-m-Y', $request->periode_awal)->format('Y-m-d'),
                'periode_akhir' => Carbon::createFromFormat('d-m-Y', $request->periode_akhir)->format('Y-m-d'),
                'cby' => auth()->user()->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Setting harga berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::channel('daily')->error('Gagal simpan setting harga', [
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
            ]);
            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal simpan setting harga.']);
        }
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $setting = DB::table('setting_harga')->where('id', $id)->first();
        $products = DB::table('products')->where('isdelete', 0)->get();

        if (!$setting) {
            return response()->json(['error' => 'Setting harga tidak ditemukan'], 404);
        }

        return view('admin.setting_harga.edit', compact('setting', 'products'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'harga' => 'required|numeric|min:0',
                'periode_awal' => 'required|date_format:d-m-Y',
                'periode_akhir' => 'required|date_format:d-m-Y|after_or_equal:periode_awal',
            ]);

            DB::table('setting_harga')
                ->where('id', $id)
                ->update([
                    'product_id' => $request->product_id,
                    'harga' => $request->harga,
                    'periode_awal' => Carbon::createFromFormat('d-m-Y', $request->periode_awal)->format('Y-m-d'),
                    'periode_akhir' => Carbon::createFromFormat('d-m-Y', $request->periode_akhir)->format('Y-m-d'),
                    'mby' => auth()->user()->id,
                    'updated_at' => now(),
                ]);

            DB::commit();
            return redirect()->back()->with('success', 'Setting harga berhasil diupdate.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::channel('daily')->error('Gagal update setting harga', [
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
            ]);
            return redirect()->back()->withErrors(['error' => 'Gagal update setting harga.']);
        }
    }


    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $setting = DB::table('setting_harga')->where('id', $id)->first();

            if (!$setting) {
                return redirect()->back()->withErrors(['error' => 'setting tidak ditemukan.']);
            }

            // Soft delete (set isdelete = 1)
            DB::table('setting_harga')->where('id', $id)->update([
                'isdelete' => 1,
                'mby' => auth()->user()->id,
                'updated_at' => now(),
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Setting harga berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::channel('daily')->error('Gagal hapus setting harga', [
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
            ]);

            return redirect()->back()->withErrors(['error' => 'Gagal hapus setting harga.']);
        }
    }

}
