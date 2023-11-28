<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VisitReferrerHost extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'host',
    ];

    /**
     * Get the referrers for the host.
     */
    public function referrers(): HasMany
    {
        return $this->hasMany(VisitReferrer::class);
    }
}
