<?php

namespace Tests\Feature;

use App\Enums\TeamUserRoleEnum;
use App\Models\Team;
use App\Models\Url;
use App\Models\User;

trait CreateTrait
{
    protected function createTeam(?User $user = null): Team
    {
        if (!$user) {
            $user = User::factory()->create(['is_admin' => false]);
        }
        $this->login($user);
        $team = $user->teams()->create(
            ['name' => $user->name . '’s Team']
        );
        /* @var \App\Models\Team $team */
        $team->users()->syncWithPivotValues(
            $user->id,
            ['role' => TeamUserRoleEnum::OWNER]
        );

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
