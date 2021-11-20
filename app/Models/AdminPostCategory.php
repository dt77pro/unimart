<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class AdminPostCategory extends Model
{
    use HasFactory;
    
    protected $table = 'post_categories';
    protected $fillable = [
        'id',
        'name',
        'slug',
        'parent_id',
        'user_id'
    ];

    public function AdminPost() {
        return $this->hasMany(AdminPost::class);
    }

    public function User() {
        return $this->belongsTo(User::class);
    }

    public function sub_category() {
        return $this->hasMany(AdminPostCategory::class, 'parent_id');
    }
    
    
   
}
