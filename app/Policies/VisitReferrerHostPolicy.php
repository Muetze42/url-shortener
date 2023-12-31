<?php

namespace App\Policies;

use App\Models\User;
use App\Models\VisitReferrerHost;

class VisitReferrerHostPolicy
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
    public function view(User $user, VisitReferrerHost $visitReferrerHost): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, VisitReferrerHost $visitReferrerHost): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, VisitReferrerHost $visitReferrerHost): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, VisitReferrerHost $visitReferrerHost): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, VisitReferrerHost $visitReferrerHost): bool
    {
        return false;
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, VisitReferrerHost $visitReferrerHost): bool
    {
        return false;
    }
}
