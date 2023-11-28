<?php

namespace App\Models;

use App\Enums\TeamUserRoleEnum;
use Illuminate\Database\Eloquent\Relations\Pivot;
use NormanHuth\HelpersLaravel\Traits\Spatie\LogsActivityTrait;

class TeamUser extends Pivot
{
    use LogsActivityTrait;

    /**
     * Determine the Model log name.
     */
    protected function getLogName(): string
    {
        return $this->formatLogName(Team::class);
    }

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'role' => TeamUserRoleEnum::class,
    ];

    /**
     * Perform any actions required after the model boots.
     *
     * @return void
     */
    public static function booted(): void
    {
        static::creating(function (self $teamUser) {
            if (!$teamUser->role) {
                $teamUser->role = TeamUserRoleEnum::MEMBER;
            }
        });
    }
}
