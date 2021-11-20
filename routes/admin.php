<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\AdminPostCategoryController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminProductCategoryController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminRoleController;
use App\Http\Controllers\AdminPermissionController;
use App\Http\Controllers\AdminContactController;
use App\Http\Controllers\AdminRecommendController;
use App\Http\Controllers\AdminTransactionController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

   
Route::group(['middleware' => 'check_login_admin'], function() { 
   
    #Dashboard
    // Route::get('admin/dashboard', [AdminDashboardController::class, 'show']);
    Route::get('dashboard', [AdminDashboardController::class, 'show'])->middleware('can:index-dashboard');

    #AdminUser
    Route::group(['admin' => ['user']], function () {
        Route::get('admin/user/list', [AdminUserController::class, 'list'])->middleware('can:list-user');
        Route::get('admin/user/add', [AdminUserController::class, 'add'])->middleware('can:add-user');
        Route::post('admin/user/store', [AdminUserController::class, 'store']);
        Route::get('admin/user/delete/{id}', [AdminUserController::class, 'delete'])->name('delete_user')->middleware('can:delete-user');
        Route::post('admin/user/action', [AdminUserController::class, 'action']);
        Route::get('admin/user/edit/{id}', [AdminUserController::class, 'edit'])->name('user.edit')->middleware('can:update-user');
        Route::post('admin/user/update/{id}', [AdminUserController::class, 'update'])->name('user.update');
    });

    #AdminRole
    Route::group(['admin' => 'role'], function () {
        Route::get('admin/role/list', [AdminRoleController::class, 'list'])->name('role.list');
        Route::get('admin/role/add', [AdminRoleController::class, 'add'])->name('role.add')->middleware('can:add-role');
        Route::post('admin/role/store', [AdminRoleController::class, 'store'])->name('role.store');
        Route::get('admin/role/edit/{id}', [AdminRoleController::class, 'edit'])->name('role.edit');
        Route::post('admin/role/update/{id}', [AdminRoleController::class, 'update'])->name('role.update');
        Route::get('admin/role/delete/{id}', [AdminRoleController::class, 'delete'])->name('role.delete');
    });

    #AdminPermission
    Route::group(['admin' => 'permission'], function () {
        Route::get('admin/permission/cat/list', [AdminPermissionController::class, 'list'])->name('permission.list')->middleware('can:list-permission');
        Route::post('admin/permission/cat/add', [AdminPermissionController::class, 'add'])->name('permission.add');
        Route::get('admin/permission/cat/edit/{id}', [AdminPermissionController::class, 'edit'])->name('permission.edit');
        Route::post('admin/permission/cat/update/{id}', [AdminPermissionController::class, 'update'])->name('permission.update');
        Route::get('admin/permission/cat/delete/{id}', [AdminPermissionController::class, 'delete'])->name('permission.delete');
    });

    #AdminAbout
    Route::group(['admin' => ['about']], function () {
        Route::get('admin/contact/add', [AdminContactController::class, 'add'])->middleware('can:add-contact');
        Route::post('admin/contact/store', [AdminContactController::class, 'store']);
        Route::get('admin/contact/edit/{id}', [AdminContactController::class, 'edit'])->middleware('can:update-contact');
        Route::post('admin/contact/update/{id}', [AdminContactController::class, 'update']);
        Route::get('admin/recommend/add', [AdminRecommendController::class, 'add'])->middleware('can:add-recommend');;
        Route::post('admin/recommend/store', [AdminRecommendController::class, 'store']);
        Route::get('admin/recommend/edit/{id}', [AdminRecommendController::class, 'edit'])->middleware('can:update-recommend');;
        Route::post('admin/recommend/update/{id}', [AdminRecommendController::class, 'update']);
  
    });


    #AdminTransaction
    Route::group(['admin' => ['transaction']], function() {
        Route::get('admin/transaction/list', [AdminTransactionController::class, 'list'])->name('admin.transaction')->middleware('can:list-order');
        Route::get('admin/transaction/trash', [AdminTransactionController::class, 'trash_transaction'])->name('admin.trash.transaction');
        Route::get('admin/transaction/delete/{id}', [AdminTransactionController::class, 'delete'])->name('delete.transaction');
        Route::get('admin/transaction/detail/{id}', [AdminTransactionController::class, 'detail'])->name('detail.transaction');
        Route::get('admin/deleteOrder/{id}', [AdminTransactionController::class, 'deleteOrderItem'])->name('delete.orderItem');
        Route::get('admin/transaction/{status}/{id}', [AdminTransactionController::class, 'status_order'])->name('status.transaction');
        Route::post('admin/transaction/action', [AdminTransactionController::class, 'action'])->name('action.transaction');

    });

    #AdminPage
    Route::group(['admin' => ['page']], function () {
        Route::get('admin/page/list', [AdminPageController::class, 'list'])->middleware('can:list-page');
        Route::get('admin/page/add', [AdminPageController::class, 'add'])->middleware('can:add-page');
        Route::post('admin/page/store', [AdminPageController::class, 'store']);
        Route::get('admin/page/detail/{id}', [AdminPageController::class, 'detail'])->name('page.detail');
        Route::get('admin/page/delete/{id}', [AdminPageController::class, 'delete'])->name('delete_page')->middleware('can:delete-page');
        Route::post('admin/page/action', [AdminPageController::class, 'action'])->name('action_page');
        Route::get('admin/page/edit/{id}', [AdminPageController::class, 'edit'])->name('edit.page')->middleware('can:update-page');
        Route::post('admin/page/update/{id}', [AdminPageController::class, 'update'])->name('update.page');
        Route::get('admin/page/trash/restore/{id}', [AdminPageController::class, 'restore_trash'])->name('restore_trash');
        Route::get('admin/page/trash/forceDelete_trash/{id}', [AdminPageController::class, 'forceDelete_trash'])->name('forceDelete_trash');
        Route::get('admin/page/trash/detail_trash/{id}', [AdminPageController::class, 'detail_trash'])->name('detail_trash');
    });

    #AdminPost
    Route::group(['admin' => 'post'], function () {
        Route::get('admin/post/list', [AdminPostController::class, 'list'])->middleware('can:list-post');
        Route::get('admin/post/add', [AdminPostController::class, 'add'])->middleware('can:add-post');
        Route::post('admin/post/store', [AdminPostController::class, 'store']);
        Route::get('admin/post/detail/{id}', [AdminPostController::class, 'detail'])->name('post.detail')->middleware('can:detail-post');
        Route::get('admin/post/delete/{id}', [AdminPostController::class, 'delete'])->name('post.delete');
        Route::get('admin/post/edit/{id}', [AdminPostController::class, 'edit'])->name('post.edit'); 
        Route::post('admin/post/update/{id}', [AdminPostController::class, 'update'])->name('post.update');
        Route::get('admin/post/trash', [AdminPostController::class, 'trash'])->name('post.trash');
        Route::get('admin/post/trash/restore/{id}', [AdminPostController::class, 'restore_trash'])->name('post.restore');
        Route::get('admin/post/trash/forceDelete/{id}', [AdminPostController::class, 'forceDelete_trash'])->name('post.forceDelete');
        Route::get('admin/post/active/{action}', [AdminPostController::class, 'active'])->name('post.active');
        Route::get('admin/post/active/update/{id}', [AdminPostController::class, 'active_update'])->name('post.active_update');
        Route::post('admin/post/action', [AdminPostController::class, 'action'])->name('post.action');
        Route::get('admin/post/status/{id}', [AdminPostController::class, 'status'])->name('post.status');

    });    

    #AdminPostCategory
    Route::group(['admin' => ['cate_post']], function () {
        Route::get('admin/post/cat/list', [AdminPostCategoryController::class, 'list'])->name('cat_post.list')->middleware('can:list-post-cate');
        Route::get('admin/post/cat/add', [AdminPostCategoryController::class, 'add'])->name('cat.add')->middleware('can:add-post-cate');
        Route::post('admin/post/cat/add', [AdminPostCategoryController::class, 'add'])->name('cat.add')->middleware('can:add-post-cate');
        Route::get('admin/post/cat/delete/{id}', [AdminPostCategoryController::class, 'delete'])->name('post_cat.delete')->middleware('can:delete-post-cate');
        Route::get('admin/post/cat/edit/{id}', [AdminPostCategoryController::class, 'edit'])->name('post_cat.edit')->middleware('can:update-post-cate');
        Route::post('admin/post/cat/update/{id}', [AdminPostCategoryController::class, 'update'])->name('post_cat.update');
    });


    #AdminProductCategory
    Route::group(['admin' => 'cate_product'], function () {
        Route::get('admin/product/cat/list', [AdminProductCategoryController::class, 'list'])->name('cat_product.list')->middleware('can:list-product-cate');
        Route::get('admin/product/cat/add', [AdminProductCategoryController::class, 'add'])->name('cat_product.add')->middleware('can:add-product-cate');
        Route::post('admin/product/cat/add', [AdminProductCategoryController::class, 'add'])->name('cat_product.add')->middleware('can:add-product-cate');
        Route::get('admin/product/cat/delete/{id}', [AdminProductCategoryController::class, 'delete'])->name('cat_product.delete')->middleware('can:delete-product-cate');
        Route::get('admin/product/cat/edit/{id}', [AdminProductCategoryController::class, 'edit'])->name('cat_product.edit')->middleware('can:update-product-cate');
        Route::post('admin/product/cat/update/{id}', [AdminProductCategoryController::class, 'update'])->name('cat_product.update');
    });


    #AdminProduct
    Route::group(['admin' => 'product'], function () {
        Route::get('admin/product/list', [AdminProductController::class, 'list'])->name('product.list')->middleware('can:list-product');
        Route::get('admin/product/detail/{id}', [AdminProductController::class, 'detail'])->name('product.detail')->middleware('can:detail-product');
        Route::get('admin/product/trash', [AdminProductController::class, 'trash'])->name('product.trash');
        Route::get('admin/product/status/{act}', [AdminProductController::class, 'status'])->name('product.status');
        Route::get('admin/product/status/update/{id}', [AdminProductController::class, 'update_status'])->name('product.update_status')->middleware('can:status-product');
        Route::get('admin/product/hot/{id}', [AdminProductController::class, 'hot'])->name('product.hot');
        Route::get('admin/product/add', [AdminProductController::class, 'add'])->name('product.add');
        Route::post('admin/product/store', [AdminProductController::class, 'store'])->name('product.store'); 
        Route::get('admin/product/edit/{id}', [AdminProductController::class, 'edit'])->name('product.edit');
        Route::post('admin/product/update/{id}', [AdminProductController::class, 'update'])->name('product.update');
        Route::get('admin/product/delete_img/{id}', [AdminProductController::class, 'delImg']);
        Route::post('admin/product/action', [AdminProductController::class, 'action'])->name('product.action')->middleware('can:action-product');
        Route::get('admin/product/delete/{id}', [AdminProductController::class, 'delete'])->name('product.delete');
        Route::get('admin/product/trash/restore/{id}', [AdminProductController::class, 'restore_trash'])->name('product.restore');
        Route::get('admin/product/trash/forceDelete/{id}', [AdminProductController::class, 'forceDelete_trash'])->name('product.forceDelete');
    });

});  


#Laravel-filemanager
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
