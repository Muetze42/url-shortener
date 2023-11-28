<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Models\Activity as Model;

class Activity extends Model
{
    use SoftDeletes;

    /**
     * The name of the "updated at" column.
     *
     * @var string|null
     */
    public const UPDATED_AT = null;

    /**
     * Get the team owns the activity.
     */
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
