<?php

namespace App\Models;

use App\Enums\TeamUserRoleEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use NormanHuth\HelpersLaravel\Traits\Spatie\LogsActivityTrait;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;
    use LogsActivityTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_admin' => 'bool',
    ];

    /**
     * Get the teams for the user.
     */
    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class)
            ->withPivot(['role'])
            ->using(TeamUser::class);
    }

    /**
     * Verify that a user is a member of a team.
     */
    public function isMemberOf(Team $team): bool
    {
        return $this->teams()
            ->withTrashed()
            ->wherePivot('team_id', $team->id)
            ->exists();
    }

    /**
     * Verify that a user is an administrator of a team.
     */
    public function isAdminOf(Team $team): bool
    {
        return $this->teams()
            ->withTrashed()
            ->wherePivot('team_id', $team->id)
            ->wherePivotIn('role', [TeamUserRoleEnum::OWNER, TeamUserRoleEnum::ADMIN])
            ->exists();
    }

    /**
     * Verify that a user is the owner of a team.
     */
    public function isOwnerOf(Team $team): bool
    {
        return $this->teams()
            ->withTrashed()
            ->wherePivot('team_id', $team->id)
            ->wherePivot('role', TeamUserRoleEnum::OWNER)
            ->exists();
    }

    /**
     * Get the IDs of the teams for the user.
     */
    public function teamIds(): array
    {
        return $this->teams->pluck('id')->toArray();
    }
}
