<?php

namespace App\Policies;

use App\Models\Team;
use App\Models\User;

class TeamPolicy
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
    public function view(User $user, Team $team): bool
    {
        return $user->is_admin || $user->isMemberOf($team);
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
    public function update(User $user, Team $team): bool
    {
        return $user->is_admin || $user->isAdminOf($team);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Team $team): bool
    {
        return $user->is_admin || $user->isOwnerOf($team);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Team $team): bool
    {
        return $user->is_admin || $user->isOwnerOf($team);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Team $team): bool
    {
        return $team->trashed() && ($user->is_admin || $user->isOwnerOf($team));
    }

    /**
     * Determine whether the user can attach any member to the team.
     */
    public function attachAnyUser(User $user, Team $team): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can detach a tag from a podcast.
     */
    public function detachUser(User $user, Team $team, User $model): bool
    {
        return $user->is_admin || $user->isAdminOf($team);
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, Team $team): bool
    {
        return false;
    }
}
