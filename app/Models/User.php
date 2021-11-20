<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;


class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'users' ;

    protected $fillable = [
        'name',
        'username',
        'password',
        'email',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function AdminPost() {
        return $this->hasMany(AdminPost::class);
    }

    public function AdminPostCategory() {
        return $this->hasMany(AdminPostCategory::class);
    }
    
    public function roles()
    {
       return $this->belongsToMany(Role::class, 'users_roles', 'user_id', 'role_id');
    }   

    public function checkPermissionAccess($permissionCheck) {

        //1. Lấy tất cả các quyền của user đang login hệ thống
        $roles = Auth::user()->roles;

        // //2. So sánh giá trị đưa vào của router hiện tại xem có tồn tại trong các quyền của mình lấy được hay ko?
        foreach ($roles as $role) {
            $permissions = $role->permissions;
            if ($permissions->contains('key_code', $permissionCheck)) {
                return true;
            }
        }
        return false;
        
    }
}    
