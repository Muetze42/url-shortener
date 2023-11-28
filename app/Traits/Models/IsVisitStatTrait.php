<?php

namespace App\Traits\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait IsVisitStatTrait
{
    /**
     * Scope a query to only include active users.
     */
    public function scopeLogCurrent(Builder $query): void
    {
        $string = Str::kebab(class_basename(get_class()));
        $query->where(
            'created_at',
            '>',
            now()->subHours(config('shortener.' . $string . '-log-limits-hour', 12))
        );
    }
}
