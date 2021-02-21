<?php

declare(strict_types=1);

namespace Tipoff\Waivers\Tests\Unit\Models;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\Waivers\Models\Signature;
use Tipoff\Waivers\Tests\TestCase;

class SignatureModelTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function create()
    {
        $model = Signature::factory()->create();
        $this->assertNotNull($model);
    }
}
