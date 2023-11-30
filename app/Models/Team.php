<?php

namespace App\Models;

use App\Enums\TeamUserRoleEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use NormanHuth\HelpersLaravel\Traits\Spatie\LogsActivityTrait;

class Team extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivityTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'icon',
    ];

    /**
     * Get the users for the team.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot(['role'])
            ->using(TeamUser::class);
    }

    /**
     * Get the urls for the team.
     */
    public function urls(): HasMany
    {
        return $this->hasMany(Url::class);
    }

    /**
     * Perform any actions required after the model boots.
     *
     * @return void
     */
    public static function booted(): void
    {
        static::created(function (self $team) {
            if (auth()->check() && !$team->users->count()) {
                $team->users()->syncWithPivotValues(
                    auth()->user()->getKey(),
                    ['role' => TeamUserRoleEnum::OWNER]
                );
            }
        });
    }
}
