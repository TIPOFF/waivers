<?php

declare(strict_types=1);

namespace Tipoff\Waivers\Tests\Feature\Nova;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\TestSupport\Models\User;
use Tipoff\Waivers\Models\Waiver;
use Tipoff\Waivers\Tests\TestCase;

class WaiverResourceTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function index()
    {
        Waiver::factory()->count(1)->create();

        $this->actingAs(User::factory()->create());

        $response = $this->getJson('nova-api/waivers')->assertOk();

        $this->assertCount(1, $response->json('resources'));
    }
}
