<?php

namespace App\Models;

use App\Traits\Models\IsVisitStatTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Visit extends Model
{
    use HasFactory;
    use IsVisitStatTrait;

    /**
     * The name of the "updated at" column.
     *
     * @var string|null
     */
    public const UPDATED_AT = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'device_type',
        'browser_family',
        'browser_version',
        'browser_engine',
        'platform_family',
        'platform_version',
        'device_family',
        'device_model',
        'crawler',
        'ip',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [];

    /**
     * Get the url that owns the visit.
     */
    public function url(): BelongsTo
    {
        return $this->belongsTo(Url::class);
    }
}
