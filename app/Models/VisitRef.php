<?php

namespace App\Models;

use App\Traits\Models\IsVisitStatTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VisitRef extends Model
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
        'value',
        'browser_hash',
    ];

    /**
     * Get the url for the ref.
     */
    public function url(): BelongsTo
    {
        return $this->belongsTo(Url::class);
    }
}
