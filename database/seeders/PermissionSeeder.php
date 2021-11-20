<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ['name' => 'Danh sách bài viết', 'parent_id' => 0, 'display_name' => 'Danh sách bài viết'],
            ['name' => 'Thêm bài viết', 'parent_id' => 1, 'display_name' => 'Thêm bài viết'],
            ['name' => 'Sửa bài viết', 'parent_id' => 1, 'display_name' => 'Sửa bài viết'],
            ['name' => 'Xóa bài viết', 'parent_id' => 1, 'display_name' => 'Xóa bài viết'],
            
            ['name' => 'Danh sách sản phẩm', 'parent_id' => 0, 'display_name' => 'Danh sách sản phẩm'],
            ['name' => 'Thêm sản phẩm', 'parent_id' => 5, 'display_name' => 'Thêm sản phẩm'],
            ['name' => 'Sửa sản phẩm', 'parent_id' => 5, 'display_name' => 'Sửa sản phẩm'],
            ['name' => 'Xóa sản phẩm', 'parent_id' => 5, 'display_name' => 'Xóa sản phẩm'],
            
        ]);
    }
}
