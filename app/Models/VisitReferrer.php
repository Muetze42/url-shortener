<?php

namespace App\Models;

use App\Traits\Models\IsVisitStatTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use NormanHuth\Helpers\Str;

class VisitReferrer extends Model
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
        'url',
        'browser_hash',
    ];

    /**
     * Get the host that owns the referrer.
     */
    public function host(): BelongsTo
    {
        return $this->belongsTo(VisitReferrerHost::class);
    }

    /**
     * Get the url for the referrer.
     */
    public function url(): BelongsTo
    {
        return $this->belongsTo(Url::class);
    }

    /**
     * Perform any actions required after the model boots.
     *
     * @return void
     */
    public static function booted(): void
    {
        static::creating(function (self $referrer) {
            $host = VisitReferrerHost::firstOrCreate(['host' => Str::getDomain($referrer->url)]);
            $referrer->visit_referrer_host_id = $host->getKey();
        });
    }
}
