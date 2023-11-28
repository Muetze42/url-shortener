<?php

namespace Database\Factories;

use App\Models\Url;
use App\Models\Visit;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class VisitFactory extends Factory
{
    protected $model = Visit::class;

    public function definition(): array
    {
        return [
            'device_type' => $this->faker->word(),
            'browser_family' => $this->faker->userAgent(),
            'browser_version' => $this->faker->semver(),
            'browser_engine' => $this->faker->word(),
            'platform_family' => $this->faker->word(),
            'platform_version' => $this->faker->semver(),
            'device_family' => $this->faker->word(),
            'device_model' => $this->faker->word(),
            'crawler' => $this->faker->word(),
            'created_at' => Carbon::now(),

            'url_id' => Url::factory(),
        ];
    }
}
