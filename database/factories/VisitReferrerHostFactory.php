<?php

namespace Database\Factories;

use App\Models\VisitReferrerHost;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use NormanHuth\Helpers\Str;

class VisitReferrerHostFactory extends Factory
{
    protected $model = VisitReferrerHost::class;

    public function definition(): array
    {
        return [
            'host' => Str::getDomain($this->faker->domainName()),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
