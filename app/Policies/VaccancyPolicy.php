<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vaccancy;
use Illuminate\Auth\Access\HandlesAuthorization;

class VaccancyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vaccancy  $vaccancy
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Vaccancy $vaccancy)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vaccancy  $vaccancy
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Vaccancy $vaccancy)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vaccancy  $vaccancy
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Vaccancy $vaccancy)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vaccancy  $vaccancy
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Vaccancy $vaccancy)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vaccancy  $vaccancy
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Vaccancy $vaccancy)
    {
        //
    }
}
