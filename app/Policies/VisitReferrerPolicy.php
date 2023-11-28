<?php

namespace App\Policies;

use App\Models\User;
use App\Models\VisitReferrer;

class VisitReferrerPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, VisitReferrer $visitReferrer): bool
    {
        return $user->is_admin || $user->isMemberOf($visitReferrer->url->tream);
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
    public function update(User $user, VisitReferrer $visitReferrer): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, VisitReferrer $visitReferrer): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, VisitReferrer $visitReferrer): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, VisitReferrer $visitReferrer): bool
    {
        return false;
    }
}
