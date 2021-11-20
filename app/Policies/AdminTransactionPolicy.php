<?php

namespace App\Policies;

use App\Models\AdminTransaction;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminTransactionPolicy
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
     * @param  \App\Models\AdminTransaction  $adminTransaction
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->checkPermissionAccess(config('permission.access_order.list_order'));

    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdminTransaction  $adminTransaction
     * @return mixed
     */
    public function update(User $user, AdminTransaction $adminTransaction)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdminTransaction  $adminTransaction
     * @return mixed
     */
    public function delete(User $user, AdminTransaction $adminTransaction)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdminTransaction  $adminTransaction
     * @return mixed
     */
    public function restore(User $user, AdminTransaction $adminTransaction)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdminTransaction  $adminTransaction
     * @return mixed
     */
    public function forceDelete(User $user, AdminTransaction $adminTransaction)
    {
        //
    }
}
