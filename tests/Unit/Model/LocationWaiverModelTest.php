<?php

declare(strict_types=1);

namespace Tipoff\Waivers\Tests\Unit\Models;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\Waivers\Models\LocationWaiver;
use Tipoff\Waivers\Tests\TestCase;

class LocationWaiverModelTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function create()
    {
        $model = LocationWaiver::factory()->create();
        $this->assertNotNull($model);
    }
}
