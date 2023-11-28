<?php

// @codingStandardsIgnoreStart

namespace Tests\Feature;

use Tests\TestCase;

class VisitTest extends TestCase
{
    use CreateTrait;

    public function test_created_url_exits(): void
    {
        $url = $this->createUrl();
        $response = $this->get('/' . $url->path);

        $response->assertStatus(302);
    }

    public function test_created_url_log_visit_exists(): void
    {
        $url = $this->createUrl();
        $response = $this->get('/' . $url->path);
        $response->assertStatus(302);

        $this->assertDatabaseCount('visits', 1);
        $this->assertDatabaseHas('visits', ['url_id' => $url->getKey()]);
    }

    public function test_created_url_ref_log_visit_exists(): void
    {
        $url = $this->createUrl();
        $response = $this->get('/' . $url->path . '?ref=test');
        $response->assertStatus(302);

        $this->assertDatabaseCount('visit_refs', 1);
        $this->assertDatabaseHas('visit_refs', ['url_id' => $url->getKey()]);
    }

    public function test_created_url_referrer_log_visit_exists(): void
    {
        $url = $this->createUrl();
        $response = $this->get('/' . $url->path, ['referer' => 'https://huth.it']);
        $response->assertStatus(302);

        $this->assertDatabaseCount('visit_referrers', 1);
        $this->assertDatabaseCount('visit_referrer_hosts', 1);
        $this->assertDatabaseHas('visit_referrers', ['url_id' => $url->getKey()]);
    }
}
