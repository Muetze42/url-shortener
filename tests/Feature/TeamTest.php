<?php

// @codingStandardsIgnoreStart

namespace Tests\Feature;

use App\Enums\TeamUserRoleEnum;
use App\Models\Team;
use App\Models\User;
use Tests\TestCase;

class TeamTest extends TestCase
{
    public function test_team_owner_authorization(): void
    {
        $user = User::factory()->create(['is_admin' => false]);
        $this->login($user);

        $team = $user->teams()->create(
            ['name' => $user->name . '’s Team']
        );
        /* @var \App\Models\Team $team */
        $team->users()->syncWithPivotValues(
            $user->id,
            ['role' => TeamUserRoleEnum::OWNER]
        );

        $this->assertTrue($user->can('view', $team));
        $this->assertTrue($user->can('update', $team));
        $this->assertTrue($user->can('delete', $team));
        $this->assertTrue($user->can('restore', $team));
        $team->delete();
        $this->assertTrue($user->can('forceDelete', $team));
    }

    public function test_team_admin_authorization(): void
    {
        $team = Team::factory()->create();
        $user = User::factory()->create(['is_admin' => false]);
        $this->login($user);
        $team->users()->attach(
            $user->id,
            ['role' => TeamUserRoleEnum::ADMIN]
        );

        $this->assertTrue($user->can('view', $team));
        $this->assertTrue($user->can('update', $team));
        $this->assertFalse($user->can('delete', $team));
        $this->assertFalse($user->can('restore', $team));
        $team->delete();
        $this->assertFalse($user->can('forceDelete', $team));
    }

    public function test_team_member_authorization(): void
    {
        $team = Team::factory()->create();
        $user = User::factory()->create(['is_admin' => false]);
        $this->login($user);
        $team->users()->attach(
            $user->id,
            ['role' => TeamUserRoleEnum::MEMBER]
        );

        $this->assertTrue($user->can('view', $team));
        $this->assertFalse($user->can('update', $team));
        $this->assertFalse($user->can('delete', $team));
        $this->assertFalse($user->can('restore', $team));
        $team->delete();
        $this->assertFalse($user->can('forceDelete', $team));
    }

    public function test_non_member_authorization(): void
    {
        $team = Team::factory()->create();
        $user = User::factory()->create(['is_admin' => false]);
        $this->login($user);

        $this->assertFalse($user->can('view', $team));
        $this->assertFalse($user->can('update', $team));
        $this->assertFalse($user->can('delete', $team));
        $this->assertFalse($user->can('restore', $team));
        $team->delete();
        $this->assertFalse($user->can('forceDelete', $team));
    }
}
