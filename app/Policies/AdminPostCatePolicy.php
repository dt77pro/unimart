<?php

namespace App\Policies;

use App\Models\AdminPostCategory;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPostCatePolicy
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
     * @param  \App\Models\AdminPostCategory  $adminPostCategory
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->checkPermissionAccess(config('permission.access_post_cate.list_post_cate'));

    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->checkPermissionAccess(config('permission.access_post_cate.add_post_cate'));
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdminPostCategory  $adminPostCategory
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->checkPermissionAccess(config('permission.access_post_cate.update_post_cate'));
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdminPostCategory  $adminPostCategory
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->checkPermissionAccess(config('permission.access_post_cate.delete_post_cate'));
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdminPostCategory  $adminPostCategory
     * @return mixed
     */
    public function restore(User $user, AdminPostCategory $adminPostCategory)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdminPostCategory  $adminPostCategory
     * @return mixed
     */
    public function forceDelete(User $user, AdminPostCategory $adminPostCategory)
    {
        //
    }
}
