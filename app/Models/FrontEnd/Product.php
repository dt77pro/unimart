<?php

namespace App\Models\FrontEnd;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;


class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'products';
    protected $guarded = [];
    
    public function category() {
        return $this->belongsTo(CateProduct::class, 'cate_id');
    }
    public function product_images() {
        return $this->hasMany(ProImgs::class, 'product_id');
    }
    public function products() {
        return $this->hasMany(Product::class,'product_id');
    }

    protected $show_status = [
        'stocking' => [
            'name' => 'Còn hàng',
            'class' => 'badge badge-success'
        ],
        'out_of_stock' => [
            'name' => 'Hết hàng',
            'class' => 'badge badge-dark'
        ]
    ];

    public function getStatus() {
        return Arr::get($this->show_status,$this->status, 'default');
    }
}
