<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\Url;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class UrlFactory extends Factory
{
    protected $model = Url::class;

    public function definition(): array
    {
        return [
            'path' => $this->faker->word(),
            'name' => $this->faker->name(),
            'target' => $this->faker->url(),
            'visits' => $this->faker->randomNumber(),
            'visits_total' => $this->faker->randomNumber(),
            'active' => $this->faker->boolean(75),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'team_id' => Team::factory(),
        ];
    }
}
