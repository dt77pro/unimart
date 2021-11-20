<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminProductCategory extends Model

{
    use HasFactory;

    protected $table = 'product_categories';
    protected $fillable = [
        'id',
        'name',
        'slug',
        'parent_id',
        'order', 
        'user_id'
    ];

    public function AdminProduct() {
        return $this->hasMany(AdminProduct::class, 'cate_id');
    }

    public function User() {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->hasMany(AdminProductCategory::class, 'parent_id');
    }
    public function childrenCategories()
    {
        return $this->hasMany(AdminProductCategory::class, 'parent_id')->with('categories');
    }
    public function parentCategories()
    {
        return $this->belongsTo(AdminProductCategory::class, 'parent_id')->with('categories');
    }

    

}
