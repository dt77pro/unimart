<?php

namespace App\Http\Controllers;

use App\Models\AdminPostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class AdminPostCategoryController extends Controller
{
    
    public function list() {
        $parents = AdminPostCategory::with('sub_category')->orderBy('id', 'desc')->get();
        $parents = data_tree($parents);
        return view('admin.post.list_cat', compact('parents'));
    }

    
    public function add(Request $request) {
         // return $request->input();
    
        if ($request->input('btn-add')) {
            $request->validate(
                [
                    'name'      => 'required|min:2|max:255|unique:post_categories|string',
                    'slug'      => 'required',
                ],
                [
                    'required'    => ':attribute không được để trống!',
                    'name.min'    => 'Tên danh mục phải lớn hơn :min kí tự!',
                    'name.unique' => 'Tên danh mục đã tồn tại'

                ],
                [
                    'name'      => 'Tên danh mục',
                    'slug'      => 'Đường dẫn'
                ]
            );
            $data['name'] = $request->name;
            $data['slug'] = $request->slug;
            $data['parent_id'] = $request->parent_id;
            $data['user_id'] = auth()->id();

            AdminPostCategory::create($data);
            
        }
        
        return redirect('admin/post/cat/list')->with(['level'=> 'success', 'status' => 'Đã thêm danh mục mới thành công']);
    }
    

    public function delete($id) {
        $parent = AdminPostCategory::where('parent_id', $id)->count();
        if ($parent == 0) {
            $category = AdminPostCategory::find($id);
            $category->delete();
           return redirect('admin/post/cat/list')->with(['level'=> 'success', 'status' => 'Xóa danh mục bài viết thành công']);

        } else {
           echo "<script type='text/javascript'>
                alert('Xin lỗi !! Cần xóa danh mục con của nó trước khi xóa danh mục này!');
                window.location = '";
                    echo route('cat_post.list');
                echo "'
           </script>";
        }
    }

    public function edit($id) {
        $parents = AdminPostCategory::with('sub_category')->orderBy('id', 'desc')->get();
        $parents = data_tree($parents);
        $select_post_cate = AdminPostCategory::where('id','!=',$id)->select('id','parent_id','name')->get();
        $category = AdminPostCategory::find($id);
        return view('admin.post.edit_cat', compact('select_post_cate','parents','category'));
          
    }

    public function update(Request $request,$id) {
        if ($request->input('btn-update')) {
            $request->validate(
            [
                'name'      => 'required|min:3|max:255|string',
                'slug'      => 'required',
                'parent_id' => 'sometimes|nullable|numeric'
            ],
            [
                'required'    => ':attribute không được để trống!',
                'name.min'    => 'Tên danh mục phải lớn hơn :min kí tự!',
            ],      
            [
                'name'      => 'Tên danh mục',
                'parent_id' => 'Danh mục cha',
                'slug'      => 'Đường dẫn'
            ]

        );
            $data['name'] = $request->name;
            $data['parent_id'] = $request->parent_id;
            $data['slug'] = $request->slug;
            $data['user_id'] = auth()->id();

            AdminPostCategory::where('id', $id)->update($data);
            return redirect('admin/post/cat/list')->with(['level'=> 'success', 'status' => 'Cập nhật danh mục thành công']);

        }
            
    }   
    
}
