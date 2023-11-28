<?php

namespace Database\Factories;

use App\Models\Url;
use App\Models\VisitRef;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class VisitRefFactory extends Factory
{
    protected $model = VisitRef::class;

    public function definition(): array
    {
        return [
            'parameter' => $this->faker->word(),
            'created_at' => Carbon::now(),

            'url_id' => Url::factory(),
        ];
    }
}
