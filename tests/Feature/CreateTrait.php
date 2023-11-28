<?php

namespace Tests\Feature;

use App\Models\Team;
use App\Models\Url;
use App\Models\User;

trait CreateTrait
{
    protected function createTeam(): Team
    {
        $user = User::factory()->create(['is_admin' => false]);
        $this->login($user);

        return $user->teams()->first();
    }

    protected function createUrl(?Team $team = null): Url
    {
        if (!$team) {
            $team = $this->createTeam();
        }

        return $team->urls()->create([
            'path' => $this->faker->word(),
            'name' => $this->faker->name(),
            'target' => $this->faker->url(),
            'visits' => $this->faker->randomNumber(),
            'visits_total' => $this->faker->randomNumber(),
            'active' => true,
        ]);
    }
}
