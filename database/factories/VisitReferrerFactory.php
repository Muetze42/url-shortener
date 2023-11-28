<?php

namespace Database\Factories;

use App\Models\Url;
use App\Models\VisitReferrer;
use App\Models\VisitReferrerHost;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class VisitReferrerFactory extends Factory
{
    protected $model = VisitReferrer::class;

    public function definition(): array
    {
        return [
            //'visit_referrer_host_id' => VisitReferrerHost::factory(),
            'url' => $this->faker->url,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'url_id' => Url::factory(),
        ];
    }
}
