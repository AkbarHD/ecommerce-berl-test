<?php

namespace App\Providers\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CategoryModel extends Model
{
    public function insertCategory($data)
    {
        return DB::table('categories')->insert([
            'name' => $data['name'],
            'cby' => $data['cby'],
            'created_at' => $data['created_at'],
            'isdelete' => $data['isdelete'],
        ]);
    }

    public function updateCategory($id, $data)
    {
        return DB::table('categories')->where('id', $id)->update([
            'name' => $data['name'],
            'mby' => $data['mby'],
            'updated_at' => $data['updated_at'],
            'isdelete' => $data['isdelete'],
        ]);
    }

    public function deleteCategory($id, $data)
    {
        return DB::table('categories')->where('id', $id)->update([
            'mby' => $data['mby'],
            'updated_at' => $data['updated_at'],
            'isdelete' => $data['isdelete'],
        ]);
    }
}
