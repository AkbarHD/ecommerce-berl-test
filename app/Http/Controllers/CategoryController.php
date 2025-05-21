<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = DB::table('categories')->where('isdelete', 0)->get();
        return view('admin.category.index', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $data['cby'] = auth()->user()->id;
            $data['created_at'] = now();
            $data['isdelete'] = 0;
            $storeCategory = app('CategoryModel')->insertCategory($data);

            DB::commit();
            return redirect()->back()->with('success', 'Category berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::channel('daily')->error('Failed to save category', [
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
            ]);

            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal menyimpan category.']);
        }
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $category = DB::table('categories')->where('id', $id)->first();

        if (!$category) {
            return response()->json(['error' => 'Data category tidak ditemukan'], 404);
        }

        return view('admin.category.edit', compact('category'));
    }

    public function update(CategoryRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $data['mby'] = auth()->user()->id;
            $data['updated_at'] = now();
            $data['isdelete'] = 0;
            $updateCategory = app('CategoryModel')->updateCategory($id, $data);

            DB::commit();
            return redirect()->back()->with('success', 'Category berhasil di update.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::channel('daily')->error('Failed to update Category', [
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
            ]);

            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal update Category.']);
        }
    }


    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $data['mby'] = auth()->user()->id;
            $data['updated_at'] = now();
            $data['isdelete'] = 1;
            $deleteCategory = app('CategoryModel')->deleteCategory($id, $data);

            DB::commit();
            return redirect()->back()->with('success', 'Category berhasil dihapus.');
        } catch (\Exception $e) {
             DB::rollBack();
            Log::channel('daily')->error('Failed to delete Category', [
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
            ]);

            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal hapus Category.']);
        }
    }
}
