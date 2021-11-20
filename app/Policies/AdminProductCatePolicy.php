<?php

namespace App\Policies;

use App\Models\AdminProductCategory;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminProductCatePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdminProductCategory  $adminProductCategory
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->checkPermissionAccess(config('permission.access_product_cate.list_product_cate'));

    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->checkPermissionAccess(config('permission.access_product_cate.add_product_cate'));

    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdminProductCategory  $adminProductCategory
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->checkPermissionAccess(config('permission.access_product_cate.update_product_cate'));

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdminProductCategory  $adminProductCategory
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->checkPermissionAccess(config('permission.access_product_cate.delete_product_cate'));

    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdminProductCategory  $adminProductCategory
     * @return mixed
     */
    public function restore(User $user, AdminProductCategory $adminProductCategory)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdminProductCategory  $adminProductCategory
     * @return mixed
     */
    public function forceDelete(User $user, AdminProductCategory $adminProductCategory)
    {
        //
    }
}
