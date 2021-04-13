<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WelcomeTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex(): void
    {
        $response = $this->get(route('welcome'));
        $response->assertOk();
    }
}
