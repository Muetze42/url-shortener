<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use NormanHuth\HelpersLaravel\Traits\Spatie\LogsActivityTrait;

class Url extends Model
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
        'path',
        'name',
        'target',
        'visits',
        'visits_total',
        'active',
        'last_visit',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'visits' => 'int',
        'visits_total' => 'int',
        'active' => 'bool',
        'last_visit' => 'datetime',
    ];

    /**
     * Get the team owns the url.
     */
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed  $value
     * @param  string|null  $field
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value, $field = null): ?Model
    {
        return $this->active()->where('path', $value)->firstOrFail();
    }

    /**
     * Scope a query to only include active urls.
     */
    public function scopeActive(Builder $query): void
    {
        $query->where('active', true);
    }

    /**
     * Get the visits for url.
     */
    public function visits(): HasMany
    {
        return $this->hasMany(Visit::class);
    }

    /**
     * Get the referrers for url.
     */
    public function referrers(): HasMany
    {
        return $this->hasMany(VisitReferrer::class);
    }

    /**
     * Get the refs for url.
     */
    public function refs(): HasMany
    {
        return $this->hasMany(VisitRef::class);
    }
}
