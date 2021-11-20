<?php

namespace App\Models\FrontEnd;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProImgs extends Model
{
    use HasFactory;

    protected $table = 'product_images';

    protected $fillable = ['id','image', 'product_id'];

    public function Product () {
        return $this->belongsTo(Product::class);
    }
}
