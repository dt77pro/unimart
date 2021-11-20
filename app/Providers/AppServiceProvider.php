<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\AdminPage;
use App\Models\AdminPost;
use App\Models\FrontEnd\CateProduct;
use App\Models\AdminProduct;
use App\Models\AdminProductCategory;
use Illuminate\Support\Str;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Schema;





class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        //
        Paginator::useBootstrap(5);

        //Post
        $posts = AdminPost::all();
        View::share('posts', $posts);

        //CateProduct
        $cate_parent = CateProduct::where('parent_id', 0)->get();
        View::share('cate_parent', $cate_parent);
        
        //Product
        $products = AdminProduct::all();
        View::share('products', $products);

        //Page
        $pages = AdminPage::all();
        View::share('pages', $pages);

        //Danh mục sản phẩm

        $menu_categories = CateProduct::with('childrenCategories')->where('parent_id', 0)->get(); 
        View::share('menu_categories', $menu_categories);

        $carts = Cart::content();
        View::share('carts', $carts);

        $product_sells = AdminProduct::where('sell', '>', 0)->orderBy('sell', 'desc')->limit(10)->get();
        View::share('product_sells', $product_sells);

        // Sản phẩm nổi bật
        $product_hots = AdminProduct::where('status', 'public')->where('hot', 1)->orderBy('hot', 'desc')->limit(6)->get();
        view()->share('product_hots', $product_hots);


        $menu_categories = CateProduct::with('childrenCategories')->where('parent_id', 0)->get(); 
        
        $products = AdminProduct::all();
        $cates = CateProduct::all();
        $cate_parent = CateProduct::where('parent_id', 0)->get();
        foreach ($cate_parent as $cate) {
            $sub_category = CateProduct::where('parent_id', $cate->id)->get();
            $sub_category[] = $cate;
            $sub_cate_by_id = array();
            foreach ($sub_category as $sub_cate) { 
                $sub_cate_by_id[] = $sub_cate->id;
            }
            $list_product_by_cateParent[$cate->id]  = AdminProduct::whereIn('cate_id', $sub_cate_by_id)->where(['hot' => 1, 'status' => 'public'])->orderBy('name', 'asc')->paginate(12, ['*'], 'page'.$cate->id);

        }
        $dataView = [
            'list_product_by_cateParent' => $list_product_by_cateParent,
            'cate_parent' => $cate_parent

        ];    
        View::share($dataView);


        //
        



        



       
      
       




}

    

}
