<?php

use App\Http\Controllers\FrontEnd\HomeController;
use App\Http\Controllers\FrontEnd\ProductController;
use App\Http\Controllers\FrontEnd\PostController;
use App\Http\Controllers\FrontEnd\RecommendController;
use App\Http\Controllers\FrontEnd\ContactController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\Auth\AdminLoginController;
// use App\Http\Controllers\FrontEnd\BuynowController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// require __DIR__.'/auth.php';

#Auth Admin
Route::group(['namespace' => 'Auth', 'prefix' => 'admin'], function() {

    #Login
    Route::get('/login', [AdminLoginController::class, 'getLogin'])
    ->name('get.login');
    Route::post('/login', [AdminLoginController::class, 'postLogin']);

    #Logout
    Route::get('/logout', [AdminLoginController::class, 'getLogout'])->name('get.logout');
    Route::post('/logout', [AdminLoginController::class, 'postLogout'])->name('post.logout');

    
});

#FrontEnd
Route::group(['namespace' => 'Frontend'], function() {

    //Search Ajax
    Route::get('/tim-kiem', [HomeController::class, 'searchAutoComplete'])->name('searchproductajax');
    Route::post('/tim-kiem', [HomeController::class, 'result']);

    //FrontEnd
    Route::get('', [HomeController::class, 'index'])->name('home');
    Route::get('/trang-chu.html', [HomeController::class, 'index'])->name('index');
    Route::get('/san-pham.html', [ProductController::class, 'index'])->name('list_product');
    Route::get('/danh-muc-san-pham/{slug}', [ProductController::class, 'cate_product'])->name('cate_product');
    Route::get('/chi-tiet-san-pham/{slug}.html', [ProductController::class, 'detail_product'])->name('detail_product');
    Route::get('/bai-viet.html', [PostController::class, 'index'])->name('post');
    Route::get('/chi-tiet-bai-viet/{slug}.html', [PostController::class, 'detail_post'])->name('detail_post');
    Route::get('lien-he.html', [ContactController::class, 'index'])->name('contact');
    Route::get('gioi-thieu.html', [RecommendController::class, 'index'])->name('recommend');
    // Route::get('mua-ngay/{slug}.html', [BuyNowController::class, 'index'])->name('buy_now');
    // Route::post('mua-ngay/{slug}.html', [BuyNowController::class, 'buy_product'])->name('post.buy_now');

    #Shopping Cart 
    Route::prefix('cart')->group(function () {
        Route::get('', [ShoppingCartController::class, 'show_cart'])->name('cart');
        Route::get('/add/{id}', [ShoppingCartController::class, 'add_cart'])->name('add.cart');
        Route::get('/mua-ngay/{slug}.html', [ShoppingCartController::class, 'buy_now_cart'])->name('buy_now.cart');
        Route::post('/update_cart/{id}', [ShoppingCartController::class, 'update_cart'])->name('update.cart');
        Route::get('/delete/{id}', [ShoppingCartController::class, 'delete_cart'])->name('delete.cart');
        Route::get('/destroy', [ShoppingCartController::class, 'destroy_cart'])->name('destroy.cart');
        Route::get('/thanh-toan.html', [ShoppingCartController::class, 'getPayment'])->name('get.payment.cart');
        Route::post('/thanh-toan.html', [ShoppingCartController::class, 'postPayment'])->name('post.payment.cart');
        Route::post('thanh-toan/district', [ShoppingCartController::class, 'get_district'])->name('payment.district');
        Route::post('thanh-toan/ward', [ShoppingCartController::class, 'get_ward'])->name('payment.ward');

    });


});







// Route::group(['middleware' => 'check_login_admin'], function() { 
   

//     #Dashboard
//     Route::get('admin/dashboard', [AdminDashboardController::class, 'show']);
//     Route::get('dashboard', [AdminDashboardController::class, 'show']);

//     #AdminUser
//     Route::group(['admin' => ['user']], function () {
//         Route::get('admin/user/list', [AdminUserController::class, 'list'])->middleware('can:list-user');
//         Route::get('admin/user/add', [AdminUserController::class, 'add'])->middleware('can:add-user');
//         Route::post('admin/user/store', [AdminUserController::class, 'store']);
//         Route::get('admin/user/delete/{id}', [AdminUserController::class, 'delete'])->name('delete_user')->middleware('can:delete-user');
//         Route::post('admin/user/action', [AdminUserController::class, 'action']);
//         Route::get('admin/user/edit/{id}', [AdminUserController::class, 'edit'])->name('user.edit')->middleware('can:update-user');
//         Route::post('admin/user/update/{id}', [AdminUserController::class, 'update'])->name('user.update');
//     });

//     #AdminRole
//     Route::group(['admin' => 'role'], function () {
//         Route::get('admin/role/list', [AdminRoleController::class, 'list'])->name('role.list');
//         Route::get('admin/role/add', [AdminRoleController::class, 'add'])->name('role.add');
//         Route::post('admin/role/store', [AdminRoleController::class, 'store'])->name('role.store');
//         Route::get('admin/role/edit/{id}', [AdminRoleController::class, 'edit'])->name('role.edit');
//         Route::post('admin/role/update/{id}', [AdminRoleController::class, 'update'])->name('role.update');
//         Route::get('admin/role/delete/{id}', [AdminRoleController::class, 'delete'])->name('role.delete');
//     });

//     #AdminPermission
//     Route::group(['admin' => 'permission'], function () {
//         Route::get('admin/permission/cat/list', [AdminPermissionController::class, 'list'])->name('permission.list');
//         Route::post('admin/permission/cat/add', [AdminPermissionController::class, 'add'])->name('permission.add');
//         Route::get('admin/permission/cat/edit/{id}', [AdminPermissionController::class, 'edit'])->name('permission.edit');
//         Route::post('admin/permission/cat/update/{id}', [AdminPermissionController::class, 'update'])->name('permission.update');
//         Route::get('admin/permission/cat/delete/{id}', [AdminPermissionController::class, 'delete'])->name('permission.delete');
//     });

//     #AdminAbout
//     Route::group(['admin' => ['about']], function () {
//         Route::get('admin/contact/add', [AdminContactController::class, 'add']);
//         Route::post('admin/contact/store', [AdminContactController::class, 'store']);
//         Route::get('admin/contact/edit/{id}', [AdminContactController::class, 'edit']);
//         Route::post('admin/contact/update/{id}', [AdminContactController::class, 'update']);
//         Route::get('admin/recommend/add', [AdminRecommendController::class, 'add']);
//         Route::post('admin/recommend/store', [AdminRecommendController::class, 'store']);
//         Route::get('admin/recommend/edit/{id}', [AdminRecommendController::class, 'edit']);
//         Route::post('admin/recommend/update/{id}', [AdminRecommendController::class, 'update']);
  
//     });


//     #Transaction
//     Route::group(['admin' => ['transaction']], function() {
//         Route::get('admin/transaction/list', [AdminTransactionController::class, 'list'])->name('admin.transaction');
//         Route::get('admin/transaction/trash', [AdminTransactionController::class, 'trash_transaction'])->name('admin.trash.transaction');
//         Route::get('admin/transaction/delete/{id}', [AdminTransactionController::class, 'delete'])->name('delete.transaction');
//         Route::get('admin/transaction/detail/{id}', [AdminTransactionController::class, 'detail'])->name('detail.transaction');
//         Route::get('admin/deleteOrder/{id}', [AdminTransactionController::class, 'deleteOrderItem'])->name('delete.orderItem');
//         Route::get('admin/transaction/{status}/{id}', [AdminTransactionController::class, 'status_order'])->name('status.transaction');
//         Route::post('admin/transaction/action', [AdminTransactionController::class, 'action'])->name('action.transaction');

//     });

//     Route::group(['admin' => ['page']], function () {
//         Route::get('admin/page/list', [AdminPageController::class, 'list']);
//         Route::get('admin/page/add', [AdminPageController::class, 'add']);
//         Route::post('admin/page/store', [AdminPageController::class, 'store']);
//         Route::get('admin/page/detail/{id}', [AdminPageController::class, 'detail'])->name('page.detail');
//         Route::get('admin/page/delete/{id}', [AdminPageController::class, 'delete'])->name('delete_page');
//         Route::post('admin/page/action', [AdminPageController::class, 'action'])->name('action_page');
//         Route::get('admin/page/edit/{id}', [AdminPageController::class, 'edit'])->name('edit.page');
//         Route::post('admin/page/update/{id}', [AdminPageController::class, 'update'])->name('update.page');
//         Route::get('admin/page/trash/restore/{id}', [AdminPageController::class, 'restore_trash'])->name('restore_trash');
//         Route::get('admin/page/trash/forceDelete_trash/{id}', [AdminPageController::class, 'forceDelete_trash'])->name('forceDelete_trash');
//         Route::get('admin/page/trash/detail_trash/{id}', [AdminPageController::class, 'detail_trash'])->name('detail_trash');
//     });
//     // End AdminPage

//     Route::group(['admin' => ['cate_post']], function () {
//         Route::get('admin/post/cat/list', [AdminPostCategoryController::class, 'list'])->name('cat_post.list');
//         Route::post('admin/post/cat/add', [AdminPostCategoryController::class, 'add'])->name('cat.add');
//         Route::get('admin/post/cat/delete/{id}', [AdminPostCategoryController::class, 'delete'])->name('post_cat.delete');
//         Route::get('admin/post/cat/edit/{id}', [AdminPostCategoryController::class, 'edit'])->name('post_cat.edit');
//         Route::post('admin/post/cat/update/{id}', [AdminPostCategoryController::class, 'update'])->name('post_cat.update');
//     });
//     //End AdminPostCategory

//     Route::group(['admin' => ['cate_product']], function () {
//         Route::get('admin/product/cat/list', [AdminProductCategoryController::class, 'list'])->name('cat_product.list');
//         Route::post('admin/product/cat/add', [AdminProductCategoryController::class, 'add'])->name('cat_product.add');
//         Route::get('admin/product/cat/delete/{id}', [AdminProductCategoryController::class, 'delete'])->name('cat_product.delete');
//         Route::get('admin/product/cat/edit/{id}', [AdminProductCategoryController::class, 'edit'])->name('cat_product.edit');
//         Route::post('admin/product/cat/update/{id}', [AdminProductCategoryController::class, 'update'])->name('cat_product.update');
//     });
//     //End AdminProductCategory

//     Route::group(['admin' => ['product']], function () {
//         Route::get('admin/product/list', [AdminProductController::class, 'list'])->name('product.list');
//         Route::get('admin/product/detail/{id}', [AdminProductController::class, 'detail'])->name('product.detail');
//         Route::get('admin/product/trash', [AdminProductController::class, 'trash'])->name('product.trash');
//         Route::get('admin/product/status/{act}', [AdminProductController::class, 'status'])->name('product.status');
//         Route::get('admin/product/hot/{id}', [AdminProductController::class, 'hot'])->name('product.hot');
//         Route::get('admin/product/add', [AdminProductController::class, 'add'])->name('product.add');
//         Route::post('admin/product/store', [AdminProductController::class, 'store'])->name('product.store');
//         Route::get('admin/product/edit/{id}', [AdminProductController::class, 'edit'])->name('product.edit');
//         Route::post('admin/product/update/{id}', [AdminProductController::class, 'update'])->name('product.update');
//         Route::get('admin/product/delete_img/{id}', [AdminProductController::class, 'delImg']);
//         Route::post('admin/product/action', [AdminProductController::class, 'action'])->name('product.action');
//         Route::get('admin/product/delete/{id}', [AdminProductController::class, 'delete'])->name('product.delete');
//         Route::get('admin/product/trash/restore/{id}', [AdminProductController::class, 'restore_trash'])->name('product.restore');
//         Route::get('admin/product/trash/forceDelete/{id}', [AdminProductController::class, 'forceDelete_trash'])->name('product.forceDelete');
//     });

// });  
// Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
//     \UniSharp\LaravelFilemanager\Lfm::routes();
// });






