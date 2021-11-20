<?php
namespace App\Services;
use Illuminate\Support\Facades\Gate;
use App\Policies\UserPolicy;
use App\Policies\AdminPostPolicy;
use App\Policies\AdminPostCatePolicy;
use App\Policies\AdminPagePolicy;
use App\Policies\AdminProductPolicy;
use App\Policies\AdminProductCatePolicy;
use App\Policies\AdminTransactionPolicy;
use App\Policies\ContactPolicy;
use App\Policies\RecommendPolicy;
use App\Policies\RolePolicy;
use App\Policies\PermissionPolicy;
use App\Policies\DashboardPolicy;



class GateAndPolicyAccess {

    public function setGateAndPolicyAccess() {

        $this->gateUserPolicy();
        $this->gateAdminPostPolicy();
        $this->gateAdminPostCatePolicy();
        $this->gateAdminPagePolicy();
        $this->gateAdminProductPolicy();
        $this->gateAdminProductCatePolicy();
        $this->gateAdminTransactionPolicy();
        $this->gateContactPolicy();
        $this->gateRecommendPolicy();
        $this->gateRolePolicy();
        $this->gatePermissionPolicy();
        $this->gateDashboardPolicy();
       
    }

    #PolicyDashboard
    public function gateDashboardPolicy() {
        Gate::define('index-dashboard', [DashboardPolicy::class, 'view']);
    }

    #PolicyUser
    public function gateUserPolicy() {
        Gate::define('list-user', [UserPolicy::class, 'view']);
        Gate::define('add-user', [UserPolicy::class, 'create']);
        Gate::define('update-user', [UserPolicy::class, 'update']);
        Gate::define('delete-user', [UserPolicy::class, 'delete']);
    }

    #PolicyAdminPost
    public function gateAdminPostPolicy() {
        Gate::define('list-post', [AdminPostPolicy::class, 'view']);
        Gate::define('add-post', [AdminPostPolicy::class, 'create']);
        Gate::define('update-post', [AdminPostPolicy::class, 'update']);
        Gate::define('delete-post', [AdminPostPolicy::class, 'delete']);
        Gate::define('detail-post', [AdminPostPolicy::class, 'detail']);
        Gate::define('action-post', [AdminPostPolicy::class, 'action']);
        Gate::define('status-post', [AdminPostPolicy::class, 'status']);
        Gate::define('restore-post', [AdminPostPolicy::class, 'restore']);
        Gate::define('forceDelete-post', [AdminPostPolicy::class, 'forceDelete']);
    }

    #PolicyAdminPostCategory
    public function gateAdminPostCatePolicy() {
        Gate::define('list-post-cate', [AdminPostCatePolicy::class, 'view']);
        Gate::define('add-post-cate', [AdminPostCatePolicy::class, 'create']);
        Gate::define('update-post-cate', [AdminPostCatePolicy::class, 'update']);
        Gate::define('delete-post-cate', [AdminPostCatePolicy::class, 'delete']);
    }

    #PolicyAdminPage
    public function gateAdminPagePolicy() {
        Gate::define('list-page', [AdminPagePolicy::class, 'view']);
        Gate::define('add-page', [AdminPagePolicy::class, 'create']);
        Gate::define('update-page', [AdminPagePolicy::class, 'update']);
        Gate::define('delete-page', [AdminPagePolicy::class, 'delete']);
        Gate::define('detail-page', [AdminPagePolicy::class, 'detail']);
        Gate::define('action-page', [AdminPagePolicy::class, 'action']);
    }

    #PolicyAdminProduct
    public function gateAdminProductPolicy() {
        Gate::define('list-product', [AdminProductPolicy::class, 'view']);
        Gate::define('add-product', [AdminProductPolicy::class, 'create']);
        Gate::define('update-product', [AdminProductPolicy::class, 'update']);
        Gate::define('delete-product', [AdminProductPolicy::class, 'delete']);
        Gate::define('detail-product', [AdminProductPolicy::class, 'detail']);
        Gate::define('action-product', [AdminProductPolicy::class, 'action']);
        Gate::define('status-product', [AdminProductPolicy::class, 'status']);
        Gate::define('hot-product', [AdminProductPolicy::class, 'hot']);
        Gate::define('forceDelete-product', [AdminProductPolicy::class, 'forceDelete']);
        Gate::define('restore-product', [AdminProductPolicy::class, 'restore']);
    }

    #PolicyAdminProductCate
    public function gateAdminProductCatePolicy() {
        Gate::define('list-product-cate', [AdminProductCatePolicy::class, 'view']);
        Gate::define('add-product-cate', [AdminProductCatePolicy::class, 'create']);
        Gate::define('update-product-cate', [AdminProductCatePolicy::class, 'update']);
        Gate::define('delete-product-cate', [AdminProductCatePolicy::class, 'delete']);
    }

    #PolicyAdminTransaction
    public function gateAdminTransactionPolicy() {
        Gate::define('list-order', [AdminTransactionPolicy::class, 'view']);
        
    }

    #PolicyContact
    public function gateContactPolicy() {
        Gate::define('add-contact', [ContactPolicy::class, 'create']);
        Gate::define('update-contact', [ContactPolicy::class, 'update']);
    }

    #PolicyRecommend
    public function gateRecommendPolicy() {
        Gate::define('add-recommend', [RecommendPolicy::class, 'create']);
        Gate::define('update-recommend', [RecommendPolicy::class, 'update']);
    }

    #PolicyRole
    public function gateRolePolicy() {
        Gate::define('list-role', [RolePolicy::class, 'view']);
        Gate::define('add-role', [RolePolicy::class, 'create']);
    }

    #PolicyPermission
    public function gatePermissionPolicy() {
        Gate::define('list-permission', [PermissionPolicy::class, 'view']);
    }
}