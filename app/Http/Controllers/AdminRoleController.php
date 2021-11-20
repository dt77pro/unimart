<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class AdminRoleController extends Controller
{
    function __construct()
    {
        $this->middleware(function($request, $next) {
            session(['module_active' => 'role']);
            return $next($request);
        });
        
    }

    public function list() {
        $page = 10;
        $roles = Role::paginate($page);
        return view('admin.role.list', compact('roles'));
    }

    public function add(Request $request) {
        $permissionParent = Permission::where('parent_id', 0)->get();
        return view('admin.role.add', compact('permissionParent'));
    }

    public function store(Request $request) {
        $role = Role::create([
            'name' => $request->name,
            'display_name' => $request->display_name,
        ]);

        $role->permissions()->attach($request->permission_id);
        return redirect()->route('role.list')->with(['status' => 'Thêm vai trò thành công']);

    }

    public function edit($id) {
        $role = Role::find($id);
        $permissionParent = Permission::where('parent_id', 0)->get();
        $permissionChecked = $role->permissions;
        return view('admin.role.edit', compact('role', 'permissionParent', 'permissionChecked'));
    }

    public function update(Request $request, $id) {
        if ($request->input('btn-update')) {
            $role = Role::find($id);
            $role->update([
                'name' => $request->name,
                'display_name' => $request->display_name
            ]);
            $role->permissions()->sync($request->permission_id);
            return redirect()->route('role.list')->with(['status' => 'Cập nhật thành công']);
            
        }
    }

    public function delete($id) {
        $role = Role::find($id);
        $role->delete();
        return redirect()->back()->with(['status' => 'Xóa vai trò thành công']) ; 
    }
}
