<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\FrontEnd\Product;
use App\Models\FrontEnd\CateProduct;
use App\Models\FrontEnd\ProImgs;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class ProductController extends Controller
{
    public function index(Request $request) {

        $per_page = 8;
        $menu_categories = CateProduct::with('childrenCategories')->where('parent_id', 0)->get(); 
        
        $products = Product::all();
        $cates = CateProduct::all();
        $cate_parent = CateProduct::where('parent_id', 0)->get();

        foreach ($cate_parent as $cate) {
            $sub_category = CateProduct::where('parent_id', $cate->id)->get();
            $sub_category[] = $cate;
            $sub_cate_by_id = array();
            foreach ($sub_category as $sub_cate) { 
                $sub_cate_by_id[] = $sub_cate->id;
            }

            if (isset($_GET['order_by'])) {
                $order_by = $_GET['order_by'];
                if ($order_by == 'none') {
                    $list_product_by_cateParent[$cate->id]  = Product::whereIn('cate_id', $sub_cate_by_id)->where('status', 'public')->paginate($per_page, ['*'], 'page'.$cate->id);
                } elseif ($order_by == 'z-a') {
                    $list_product_by_cateParent[$cate->id]  = Product::whereIn('cate_id', $sub_cate_by_id)->where('status', 'public')->orderBy('name', 'desc')->paginate($per_page, ['*'], 'page'.$cate->id);
                } elseif ($order_by == 'tang-dan') {
                    $list_product_by_cateParent[$cate->id]  = Product::whereIn('cate_id', $sub_cate_by_id)->where('status', 'public')->orderBy('price', 'asc')->paginate($per_page, ['*'], 'page'.$cate->id);
                } elseif ($order_by == 'giam-dan') {
                    $list_product_by_cateParent[$cate->id]  = Product::whereIn('cate_id', $sub_cate_by_id)->where('status', 'public')->orderBy('price', 'desc')->paginate($per_page, ['*'], 'page'.$cate->id);
                } elseif ($order_by == 'a-z') {
                    $list_product_by_cateParent[$cate->id]  = Product::whereIn('cate_id', $sub_cate_by_id)->where('status', 'public')->orderBy('name', 'asc')->paginate($per_page, ['*'], 'page'.$cate->id);
                }
            } else {
                $list_product_by_cateParent[$cate->id]  = Product::whereIn('cate_id', $sub_cate_by_id)->where('status', 'public')->orderBy('price', 'desc')->paginate($per_page, ['*'], 'page'.$cate->id);
            }
        }

        return view('frontend.pages.product.index', compact('list_product_by_cateParent', 'cate_parent', 'menu_categories', 'products'));

    }

    public function cate_product(Request $request) { 
        $menu_categories = CateProduct::with('childrenCategories')->where('parent_id', 0)->get(); 
        $cates_product = CateProduct::all();
        $url = $request->segment(2);
        $url = preg_split("/[\s,-.]+/", $url);

        //Lấy id của danh mục
        if ($id = array_pop($url)) {

            //Lấy all sản phẩm theo danh mục
          
            $cate = CateProduct::find($id);
            $sub_category = data_tree($cates_product, $id);
            $sub_array = array();
            foreach ($sub_category as $sub) {
                $sub_array[] = $sub->id;
            }
            $list_product_by_cates = array_push($sub_array, $id);
          
            //Lọc giá sản phẩm theo danh mục

            $query = array();
            if ($request->p) {
                $price = $request->p;

                if ($price == 'duoi-1-trieu') {
                    $query[] = ['price', '<', 1000000];
                
                } elseif ($price == 'tu-1-3-trieu') {
                    $query[] = ['price', '>=', 1000000];
                    $query[] = ['price', '<', 3000000];

                } elseif ($price == 'tu-3-5-trieu') {
                    $query[] = ['price', '>=', 3000000];
                    $query[] = ['price', '<', 5000000];

                } elseif ($price == 'tu-5-7-trieu') {
                    $query[] = ['price', '>=', 5000000];
                    $query[] = ['price', '<', 7000000];

                } elseif ($price == 'tu-7-10-trieu') {
                    $query[] = ['price', '>=', 7000000];
                    $query[] = ['price', '<', 10000000];

                } elseif ($price == 'tren-10-trieu') {
                    $query[] = ['price', '>=', 10000000];
                }
            }

            //Lọc theo thương hiệu sản phẩm

            $page = 4;

            $list_brands = CateProduct::where('parent_id', $id)->get();
            if ($request->brand != 'all_product') {
                $brand = $request->input('brand');
                $query[] = ['name', 'LIKE', '%'.$brand.'%'];
                $list_product_by_cates = Product::whereIn('cate_id', $sub_array)->where($query)->where('status', 'public')->orderBy('id', 'DESC')->paginate();

            } 

            //Sắp sắp sản phẩm theo danh mục
           
            if ($request->order_by) {
                $order_by = $request->order_by;

                if ($request->order_by == 'a-z') {
                    $list_product_by_cates = Product::whereIn('cate_id', $sub_array)->where('status', 'public')->where($query)->orderBy('name', 'ASC')->paginate();
                } elseif($request->order_by == 'z-a') {
                    $list_product_by_cates = Product::whereIn('cate_id', $sub_array)->where('status', 'public')->where($query)->orderBy('name', 'DESC')->paginate();
                } elseif($request->order_by == 'giam-dan') {
                    $list_product_by_cates = Product::whereIn('cate_id', $sub_array)->where('status', 'public')->where($query)->orderBy('price', 'DESC')->paginate();
                } elseif($request->order_by == 'tang-dan') {
                    $list_product_by_cates = Product::whereIn('cate_id', $sub_array)->where('status', 'public')->where($query)->orderBy('price', 'ASC')->paginate();
                } elseif($request->order_by == 'none'){
                    $list_product_by_cates = Product::whereIn('cate_id', $sub_array)->where('status', 'public')->where($query)->orderBy('create_at', 'desc')->paginate();
                }
            } 
            else {
                $list_product_by_cates = Product::whereIn('cate_id', $sub_array)->where('status', 'public')->where($query)->orderBy('id', 'DESC')->paginate($page);
            }
            $count_products = Product::whereIn('cate_id', $sub_array)->where('status', 'public')->where($query)->count();

          
        } 

        //Pagination
        if ($request->ajax()) {
            $html = view('frontend.pages.product.load_more_product', compact('list_product_by_cates'));
            return response($html);
        }

        return view('frontend.pages.product.list_cate', compact('list_product_by_cates', 'menu_categories', 'cate', 'list_brands', 'count_products'));
    }

    //Detail_product 
    public function detail_product(Request $request, $slug) {
        $product = Product::where('slug', $slug)->first();
        // $product_img =  $product->featured_img_path;
        // return $product_img;
        $product_img_detail = Product::find($product->id)->product_images()->get();
        $cates = CateProduct::find($product->cate_id);
        $parent_cate = CateProduct::find($product->cate_id)->parentCategories;
        $products_with_cate = Product::where('name', 'LIKE', '%'. $parent_cate->name .'%')->whereNotIn('name', [$product->name])->orderBy('id', 'desc')->get();
        return view('frontend.pages.product_detail.index', compact('product', 'product_img_detail', 'products_with_cate', 'parent_cate'));
    }
}    