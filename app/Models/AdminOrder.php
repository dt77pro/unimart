<?php

namespace App\Models;

use App\Models\FrontEnd\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminOrder extends Model
{
    use HasFactory;

    
    protected $table = 'orders';

    protected $fillable = [
        'id',
        'product_id',
        'qty',
        'price', 
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    
}
