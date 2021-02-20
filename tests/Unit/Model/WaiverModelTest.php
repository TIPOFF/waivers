<?php

declare(strict_types=1);

namespace Tipoff\Waivers\Tests\Unit\Models;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\Waivers\Models\Waiver;
use Tipoff\Waivers\Tests\TestCase;

class WaiverModelTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function create()
    {
        $model = Waiver::factory()->create();
        $this->assertNotNull($model);
    }
}
