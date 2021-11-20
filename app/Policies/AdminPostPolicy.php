<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPostPolicy
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
     * @param  \App\Models\AdminPost  $adminPost
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->checkPermissionAccess(config('permission.access_post.list_post'));

    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->checkPermissionAccess(config('permission.access_post.add_post'));

    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdminPost  $adminPost
     * @return mixed
     */ 
    public function update(User $user,$post)
    {
        
        if ($user->checkPermissionAccess(config('permission.access_post.update_post')) || ($user->id === $post->user_id)) {
            return true;
        }
        return false;

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdminPost  $adminPost
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->checkPermissionAccess(config('permission.access_post.delete_post'));

    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdminPost  $adminPost
     * @return mixed
     */
    public function restore(User $user)
    {
        return $user->checkPermissionAccess(config('permission.access_post.restore_post'));

    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdminPost  $adminPost
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        return $user->checkPermissionAccess(config('permission.access_post.forceDelete_post'));

    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdminPost  $adminPost
     * @return mixed
     */
    public function detail(User $user)
    {
        return $user->checkPermissionAccess(config('permission.access_post.detail_post'));

    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdminPost  $adminPost
     * @return mixed
     */
    public function action(User $user)
    {
        return $user->checkPermissionAccess(config('permission.access_post.action_post'));

    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdminPost  $adminPost
     * @return mixed
     */
    public function status(User $user)
    {
        return $user->checkPermissionAccess(config('permission.access_post.status_post'));

    }
}
