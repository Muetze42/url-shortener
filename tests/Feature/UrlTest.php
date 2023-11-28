<?php

// @codingStandardsIgnoreStart

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class UrlTest extends TestCase
{
    use CreateTrait;

    public function test_team_can_create_url(): void
    {
        $team = $this->createTeam();

        $url = $this->createUrl($team);

        $this->assertModelExists($url);
    }

    public function test_team_admin_authorization(): void
    {
        $user = User::factory()->create(['is_admin' => false]);
        $this->login($user);

        $team = $user->teams()->first();
        $url = $this->createUrl($team);

        $this->assertTrue($user->can('view', $url));
        $this->assertTrue($user->can('update', $url));
        $this->assertTrue($user->can('delete', $url));
        $this->assertTrue($user->can('restore', $url));
        $team->delete();
        $this->assertTrue($user->can('forceDelete', $url));
    }
}
