<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\FrontEnd\Product;
use App\Models\FrontEnd\CateProduct;
use App\Models\FrontEnd\CateProduct as FrontEndCateProduct;
use Illuminate\Http\Request;

use Illuminate\Support\Arr;


class CateProductController extends Controller
{
    
    public function index()
    {
        $menu_categories = CateProduct::with('childrenCategories')->where('category_id', 0)
        ->with('childrenCategories')
        ->get();
       // dd($categories);
       return view('/', compact('menu_categories'));
         
    }
}
