<?php

declare(strict_types=1);

namespace Tipoff\Waivers\Tests\Feature\Nova;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\TestSupport\Models\User;
use Tipoff\Waivers\Models\Signature;
use Tipoff\Waivers\Tests\TestCase;

class SignatureResourceTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function index()
    {
        Signature::factory()->count(4)->create();

        $this->actingAs(User::factory()->create());

        $response = $this->getJson('nova-api/signatures')
            ->assertOk();

        $this->assertCount(4, $response->json('resources'));
    }
}
