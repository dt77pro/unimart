<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AdminProductCategory;
use App\Models\FrontEnd\CateProduct;
use App\Models\FrontEnd\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        
        $menu_categories = AdminProductCategory::where('parent_id', 0)->with('childrenCategories')->get(); 
        return view('frontend.pages.home.index', compact('menu_categories'));
    }

    public function searchAutoComplete(Request $request) {
        $query = $request->get('term', '');
        $products = Product::where('name', 'LIKE', '%'.$query.'%')->get();
        $cate_products = CateProduct::where('name', 'LIKE', '%'.$query.'%')->get();

        $data = [];
        foreach ($products as $product) {
            $data[] = [
                'value' => $product->name,
                'id' => $product->id
            ];
        }
        foreach ($cate_products as $cate_product) {
            $data[] = [
                'value' => $cate_product->name,
                'id' => $cate_product->id
            ];
        }

        if (count($data)) {
            return $data;
        } else {
            return ['value' => 'Không tìm thấy kết quả nào', 'id' => ''];
        }
    }

    public function result(Request $request) {
        $searching_data = $request->input('search_product');
        $products = Product::where('name', 'LIKE', '%'.$searching_data.'%')->first();
        $cate_product = CateProduct::where('name', 'LIKE', '%'.$searching_data.'%')->first();

        if ($products) {
            if (isset($_POST['searchbtn'])) {
                return redirect('danh-muc-san-pham/'.$cate_product->slug.'-'.$cate_product->id);
                
            }
            else {
                return redirect('chi-tiet-san-pham/'.$products->slug.'.'.'html'); 

            } 
        } else {
            return redirect('');
        }
        


    }
}
