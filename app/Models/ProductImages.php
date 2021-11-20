<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    use HasFactory;

    protected $table = 'product_images';

    protected $fillable = ['id','image', 'product_id'];

    public function AdminProduct () {
        return $this->belongsTo(AdminProduct::class);
    }
}
