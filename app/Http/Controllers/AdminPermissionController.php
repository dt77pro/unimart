<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;


class AdminPermissionController extends Controller
{
    function __construct()
    {
        $this->middleware(function($request, $next) {
            session(['module_active' => 'permission']);
            return $next($request);
        });
        
    }

    public function list() {
        $categories_permission = Permission::with('permissionsChildren')->orderBy('id', 'desc')->get();
        $parent_permission = Permission::all();
        return view('admin.permission.list', compact('categories_permission', 'parent_permission'));
    }

    public function add(Request $request) {
        if ($request->input('btn-add')) {
            $request->validate(
                [
                    'name'      => 'required|min:2|max:255|unique:permissions|string',
                    'display_name'      => 'required',
                    'key_code'      => 'required',
                ],
                [
                    'required'    => ':attribute không được để trống!',
                    'name.min'    => 'Tên danh mục phải lớn hơn :min kí tự!',
                    'name.unique' => 'Tên danh mục đã tồn tại'

                ],
                [
                    'name'      => 'Tên danh mục',
                    'display_name'      => 'Đường dẫn',
                    'key_code'      => 'Mã khóa'
                ]
            );
            $data['name'] = $request->name;
            $data['display_name'] = $request->display_name;
            $data['parent_id'] = $request->parent_id;
            $data['key_code'] = $request->key_code;

            Permission::create($data);
            
        }
        
        return redirect('admin/permission/cat/list')->with(['level'=> 'success', 'status' => 'Đã thêm danh mục mới thành công']);
    }

    public function edit($id) {
        $permission = Permission::find($id);
        $categories_permission = Permission::with('permissionsChildren')->orderBy('id', 'desc')->get();
        $parent_permission = Permission::all();
        return view('admin.permission.edit', compact('permission', 'categories_permission', 'parent_permission'));
    }

    public function update(Request $request, $id) {
        if ($request->input('btn-update')) {
            $request->validate(
                [
                    'name'      => 'required|min:2|max:255|string',
                    'display_name'      => 'required',
                    'key_code'      => 'required',
                ],
                [
                    'required'    => ':attribute không được để trống!',
                    'name.min'    => 'Tên danh mục phải lớn hơn :min kí tự!',
                    'name.unique' => 'Tên danh mục đã tồn tại'

                ],
                [
                    'name'      => 'Tên danh mục',
                    'display_name'      => 'Đường dẫn',
                    'key_code'      => 'Mã khóa'
                ]
            );
            $data['name'] = $request->name;
            $data['display_name'] = $request->display_name;
            $data['parent_id'] = $request->parent_id;
            $data['key_code'] = $request->key_code;

            Permission::where('id', $id)->update($data);
            
        }
        
        return redirect('admin/permission/cat/list')->with(['level'=> 'success', 'status' => 'Cập nhật danh mục thành công']);
    }

    public function delete($id) {
        $parent_permission = Permission::where('parent_id', $id)->count();
        if ($parent_permission == 0) {
            $permission = Permission::find($id);
            $permission->delete();
            return redirect()->route('permission.list')->with(['level'=> 'success', 'status' => 'Xóa danh mục phân quyền thành công']);

        } else {
            echo "<script type='text/javascript'>
                alert('Xin lỗi !! Cần xóa danh mục con của nó trước khi xóa danh mục này!');
                window.location = '";
                    echo route('permission.list');
                echo "'
            </script>";
        }
    
    }
}
