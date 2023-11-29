<?php

namespace App\Policies;

use App\Models\Url;
use App\Models\User;

class UrlPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->teams->count();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Url $url): bool
    {
        return $user->is_admin || $user->isMemberOf($url->team);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Url $url): bool
    {
        return $user->is_admin || $user->isMemberOf($url->team);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Url $url): bool
    {
        return $user->is_admin || $user->isMemberOf($url->team);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Url $url): bool
    {
        return $user->is_admin || $user->isMemberOf($url->team);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Url $url): bool
    {
        return $user->is_admin || $user->isAdminOf($url->team);
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, Url $url): bool
    {
        return false;
    }
}
