<?php

namespace App\Models\FrontEnd;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CateProduct extends Model
{
    use HasFactory;

    protected $table = 'product_categories';

    public function categories()
    {
        return $this->hasMany(CateProduct::class, 'parent_id');
    }
    public function childrenCategories()
    {
        return $this->hasMany(CateProduct::class, 'parent_id')->with('categories');
    }
    public function parentCategories()
    {
        return $this->belongsTo(CateProduct::class, 'parent_id')->with('categories');
    }

    
    public function products() {
        return $this->hasMany(Product::class);
    }

    public function sub_products() {
        return $this->hasManyThrough(Product::class, self::class, 'parent_id', 'cate_id');
    }
}
