<?php

namespace App\Policies;

use App\Models\AdminProduct;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminProductPolicy
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
     * @param  \App\Models\AdminProduct  $adminProduct
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->checkPermissionAccess(config('permission.access_product.list_product'));

    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->checkPermissionAccess(config('permission.access_product.add_product'));
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdminProduct  $adminProduct
     * @return mixed
     */
    public function update(User $user, $product)
    {
        if ($user->checkPermissionAccess(config('permission.access_product.update_product')) || ($user->id === $product->user_id)) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdminProduct  $adminProduct
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->checkPermissionAccess(config('permission.access_product.delete_product'));

    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdminProduct  $adminProduct
     * @return mixed
     */
    public function restore(User $user)
    {
        return $user->checkPermissionAccess(config('permission.access_product.restore_product'));

    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdminProduct  $adminProduct
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        return $user->checkPermissionAccess(config('permission.access_product.forceDelete_product'));

    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdminProduct  $adminProduct
     * @return mixed
     */
    public function detail(User $user)
    {
        return $user->checkPermissionAccess(config('permission.access_product.detail_product'));

    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdminProduct  $adminProduct
     * @return mixed
     */
    public function action(User $user)
    {
        return $user->checkPermissionAccess(config('permission.access_product.action_product'));

    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdminProduct  $adminProduct
     * @return mixed
     */
    public function status(User $user)
    {
        return $user->checkPermissionAccess(config('permission.access_product.status_product'));

    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdminProduct  $adminProduct
     * @return mixed
     */
    public function hot(User $user)
    {
        return $user->checkPermissionAccess(config('permission.access_product.hot_product'));

    }
}
