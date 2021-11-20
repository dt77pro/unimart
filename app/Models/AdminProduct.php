<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;


class AdminProduct extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $table = 'products';

    protected $fillable = [
        'id',
        'name',
        'slug',
        'content',
        'description',
        'featured_img_name',
        'featured_img_path',
        'price',
        'qty',
        'cate_id',
        'status',
        'user_id'
    ];

    
    protected $show_status = [
        'public' => [
            'name' => 'Công khai',
            'class' => 'badge badge-primary'
        ],
        'pending' => [
            'name' => 'Chờ duyệt',
            'class' => 'badge badge-dark'
        ]
    ];

    public function getStatus() {
        return Arr::get($this->show_status,$this->status, 'default');
    }

    public function AdminProductCategory() {
        return $this->belongsTo(AdminProductCategory::class);
    }

    public function User() {
        return $this->belongsTo(User::class);
    }

    public function product_images() {
        return $this->hasMany(ProductImages::class, 'product_id');
    }
}
