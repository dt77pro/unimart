<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $table = 'permissions';

    protected $guarded = [];

    public function permissionsChildren()
    {
        return $this->hasMany(Permission::class, 'parent_id');
    }

    public function roles() {

        return $this->belongsToMany(Role::class, 'roles_permissions');
            
    }
     
     public function users() {
     
        return $this->belongsToMany(User::class, 'users_permissions');
            
     }
}
