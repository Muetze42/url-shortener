<?php

// @codingStandardsIgnoreStart

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_can_create_users(): void
    {
        User::factory(5)->create();

        $this->assertDatabaseCount('users', 5);
    }

    public function test_created_user_exists(): void
    {
        $user = User::factory()->create();

        $this->assertModelExists($user);
    }
}
