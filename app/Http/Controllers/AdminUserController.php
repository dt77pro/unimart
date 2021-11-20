<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;


class AdminUserController extends Controller
{
    //
    function __construct()
    {
        $this->middleware(function($request, $next) {
            session(['module_active' => 'user']);
            return $next($request);
        });
        
    }

    function list(Request $request) {
        // return $request->input('keyword');
        $status = $request->input('status');
        $list_act = [
            'delete' => 'Xóa tạm thời'
        ];
        if ($status == 'trash') {
            $list_act = [
                'restore' => 'Khôi phục',
                'forceDelete' => 'Xóa vĩnh viễn'
            ];
            $users = User::onlyTrashed()->paginate();
            
        } else {
            $keyword = "";
            if ($request->input('keyword')) {
                $keyword = $request->input('keyword');
            }
            $users = User::where('name', 'LIKE', "%{$keyword}%")->paginate();
            // dd($users->total());
        }
        
        $count_user_active = User::count();
        $count_user_trash = User::onlyTrashed()->count();
        $count = [$count_user_active, $count_user_trash];
        
        return view('admin.user.list', ['users' => $users, 'count' => $count, 'list_act' => $list_act]);
    }

    function add() {
        $roles = Role::all();
        return view('admin.user.add', compact('roles'));
    }

    function store(Request $request) {
        if ($request->input('btn-add')) {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'username' => ['required', 'string', 'max:255', 'unique:users', 'alpha_dash'],
                'password' => 'required|string|confirmed|min:8',
            ],
            [
                'required' => ':attribute không được để trống!',
                'min' => ':attribute có độ dài ít nhất :min ký tự',
                'max' => ':attribute có độ dài tối đa :max ký tự',
                'confirmed' => 'Xác nhận mật khẩu không thành công',
                'unique' => ':attribute đã tồn tại!'
            ],
            [
                'name' => 'Tên người dùng',
                'password' => 'Mật khẩu',
                'username' => 'Tên đăng nhập',
            ]
            );

            try {
                DB::beginTransaction();
                $user = User::create([
                    'name' => $request->input('name'),
                    'username' => $request->input('username'),
                    'email' => $request->input('email'),
                    'password' => Hash::make($request->password),
                ]); 
                $user->roles()->attach($request->role_id);
                DB::commit();
                return redirect('admin/user/list')->with('status', 'Thêm mới thành viên thành công') ; 
            } catch (Exception $e) {
                DB::rollBack();
                report($e);
        
                return false;
            }
        
        }
    }

    
    function edit($id) {
        
        $roles = Role::all();
        $user = User::find($id);
        $rolesOfUser = $user->roles;
        return view('admin.user.edit', compact('user', 'roles', 'rolesOfUser'));
    } 
 
    function update(Request $request, $id) {

        if ($request->input('btn-update')) {
            $request->validate(
                [
                    'name' => 'required|string|max:250',
                    'password' => 'required|string|min:8|confirmed',
                ],
                [
                    'required' => ':attribute không được để trống!',
                    'min' => ':attribute có độ dài ít nhất :min ký tự',
                    'max' => ':attribute có độ dài tối đa :max ký tự',
                    'confirmed' => 'Xác nhận mật khẩu không thành công',
                ],
                [
                    'name' => 'Tên người dùng',
                    'password' => 'Mật khẩu',
                ]
            );
            try {
                DB::beginTransaction();
                
                $data['name'] = $request->name;
                $data['username'] = $request->username;
                $data['password'] = Hash::make($request->password);
                $user = User::where('id', $id)->update($data);
                
                $user = User::find($id);
                $user->roles()->sync($request->role_id);
                DB::commit();
                return redirect('admin/user/list')->with('status', 'Đã cập nhật thành công') ; 
            } catch (Exception $exception) {
                DB::rollBack();
                Log::error('Message :' . $exception->getMessage() . '--- Line: ' . $exception->getLine());
            }
        }
        
    }


    function delete($id) {
        if (Auth::id() != $id && Auth::id() != 'null') {
            $user = User::find($id);
            $user->delete();
            return redirect('admin/user/list')->with('status', 'Xóa thành viên thành công') ;   
            
        } else {
            return redirect('admin/user/list')->with('status', 'Không thể xóa thành viên này?');
        }
        

    }

    function action(Request $request) {
        $list_check = $request->input('list_check');
        if ($list_check) {
            // return $request->input('list_check');
            foreach ($list_check as $k => $id) {
                if (Auth::id() == $id) {
                    unset($list_check[$k]);
                }
            }    
            if (!empty($list_check)) {
                $act = $request->input('act');
                if ($act == 'delete') {
                    User::destroy($list_check);
                    return redirect('admin/user/list')->with('status', 'Bạn đã xóa thành công');
                }

                if ($act == 'restore') {
                    User::withTrashed()->whereIn('id', $list_check)->restore();
                    return redirect('admin/user/list')->with('status', 'Bạn đã khôi phục thành công');

                }

                if ($act == 'forceDelete') {
                    User::withTrashed()
                    ->whereIn('id', $list_check)
                    ->forceDelete();
                    return redirect('admin/user/list')->with('status', 'Bạn đã xóa vĩnh viễn thành viên khỏi hệ thống!');
                }
            }
            return redirect('admin/user/list')->with('Bạn không thể thao tác trên tài khoản này');
        } else {
            return redirect('admin/user/list')->with('status', 'Bạn cần lựa chọn thao tác để thực hiện!');
        }
    }

}

