<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name')
            ->where('products.isdelete', 0)
            ->get();

        $categories = DB::table('categories')->where('isdelete', 0)->get();

        return view('admin.product.index', compact('products', 'categories'));
    }


    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            // Validasi data
            $request->validate([
                'nama_product' => 'required|string|max:255',
                'category_id' => 'required|integer|exists:categories,id',
                'gambar' => 'required|mimes:jpeg,png,jpg|max:2048',
                'keterangan' => 'required|string',
            ]);

            // Default path kosong
            $gambarPath = null;

            // Jika ada file gambar diupload
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/products'), $filename); // simpan ke /public/uploads/products
                $gambarPath = 'uploads/products/' . $filename;
            }

            // Simpan data ke database pakai query builder
            DB::table('products')->insert([
                'nama_product' => $request->nama_product,
                'category_id' => $request->category_id,
                'gambar' => $gambarPath,
                'keterangan' => $request->keterangan,
                'cby' => auth()->user()->id,
                'isdelete' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Produk berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::channel('daily')->error('Failed to tambah Product', [
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
            ]);

            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal Tambah Product.']);
        }
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $product = DB::table('products')->where('id', $id)->first();

        if (!$product) {
            return response()->json(['error' => 'Data product tidak ditemukan'], 404);
        }

        $categories = DB::table('categories')->where('isdelete', 0)->get(); // penting

        return view('admin.product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'nama_product' => 'required|string|max:255',
                'category_id' => 'required|integer|exists:categories,id',
                'keterangan' => 'required|string',
                'gambar' => 'nullable|mimes:jpeg,png,jpg|max:2048',
            ]);

            $product = DB::table('products')->where('id', $id)->first();

            if (!$product) {
                return redirect()->back()->withErrors(['error' => 'Produk tidak ditemukan.']);
            }

            $gambarPath = $product->gambar;

            // Jika gambar baru diupload
            if ($request->hasFile('gambar')) {
                if ($gambarPath && file_exists(public_path($gambarPath))) {
                    unlink(public_path($gambarPath));
                }

                $file = $request->file('gambar');
                $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/products'), $filename);
                $gambarPath = 'uploads/products/' . $filename;
            }

            DB::table('products')->where('id', $id)->update([
                'nama_product' => $request->nama_product,
                'category_id' => $request->category_id,
                'keterangan' => $request->keterangan,
                'gambar' => $gambarPath,
                'mby' => auth()->user()->id,
                'updated_at' => now(),
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Produk berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::channel('daily')->error('Update product gagal', [
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
            ]);

            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat update produk.']);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $product = DB::table('products')->where('id', $id)->first();

            if (!$product) {
                return redirect()->back()->withErrors(['error' => 'Produk tidak ditemukan.']);
            }

            // Hapus file gambar jika ada
            if ($product->gambar && file_exists(public_path($product->gambar))) {
                unlink(public_path($product->gambar));
            }

            // Soft delete (set isdelete = 1)
            DB::table('products')->where('id', $id)->update([
                'isdelete' => 1,
                'mby' => auth()->user()->id,
                'updated_at' => now(),
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Produk berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::channel('daily')->error('Gagal hapus produk', [
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
            ]);

            return redirect()->back()->withErrors(['error' => 'Gagal hapus produk.']);
        }
    }
}
