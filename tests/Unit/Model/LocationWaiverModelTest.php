<?php

declare(strict_types=1);

namespace Tipoff\Waivers\Tests\Unit\Models;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\Waivers\Tests\TestCase;
use Tipoff\Waivers\Models\LocationWaiver;

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
