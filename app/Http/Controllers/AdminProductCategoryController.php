<?php

namespace App\Http\Controllers;

use App\Models\AdminProduct;
use App\Models\AdminProductCategory;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;


class AdminProductCategoryController extends Controller
{
    public function list() {
        $parent = AdminProductCategory::all();
        $categories = AdminProductCategory::all();
        $categories = data_tree($categories);
        
        return view('admin.product.list_cat', compact('categories', 'parent'));
    }

    public function add(Request $request) {
        if ($request->input('btn-add')) {
            $this->validate($request,[
                'name'      => 'required|min:1|max:255|string',
                'slug'      => 'required',
            ],
            [
                'required'              => ':attribute không được để trống!',
                'name.min'              => 'Tên danh mục phải lớn hơn :min kí tự!',
            ],
            [
                'name'      => 'Tên danh mục',
                'slug'      => 'Đường dẫn'
            ]);
        
            $add_category = new AdminProductCategory;
            $add_category::create([
                'name' => $request->name,
                'slug' => $request->slug,
                'parent_id' => $request->parent_id,
                'user_id' => auth('admins')->id()
            ]);
        }
        return redirect('admin/product/cat/list')->with(['level'=> 'success', 'status' => 'Đã thêm danh mục mới thành công']);

    }

    public function delete($id) {
        $parent = AdminProductCategory::where('parent_id', $id)->count();
        if ($parent == 0) {
            $category = AdminProductCategory::find($id);
            $category->delete();
            return back()->with(['level'=> 'success', 'status' => 'Xóa danh mục sản phẩm thành công']);

        } else {
            echo "<script type='text/javascript'>
                alert('Xin lỗi !! Cần xóa danh mục con của nó trước khi xóa danh mục này!');
                window.location = '";
                    echo route('cat_product.list');
                echo "'
           </script>";
        }
        
    }

    public function edit($id) {
        $categories = AdminProductCategory::orderBy('name', 'asc')->get();
        $category = AdminProductCategory::find($id);
        $parent = AdminProductCategory::where('id', '!=', $id)->get();


        return view('admin.product.edit_cat', compact('parent', 'categories', 'category'));
    }

    public function update(Request $request,$id) {
        if ($request->input('btn-update')) {
            $request->validate(
            [
                'name'      => 'required|min:1|max:255|string',
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
            ]);

            $data['name'] = $request->name;
            $data['parent_id'] = $request->parent_id;
            $data['slug'] = $request->slug;
            $data['user_id'] = auth()->id();

            AdminProductCategory::where('id', $id)->update($data);
            return redirect('admin/product/cat/list')->with(['level'=> 'success', 'status' => 'Cập nhật danh mục sản phẩm thành công']);

        }
            
    } 
    
}
