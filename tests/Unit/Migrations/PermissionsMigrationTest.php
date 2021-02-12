<?php

declare(strict_types=1);

namespace Tipoff\Waivers\Tests\Unit\Migrations;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Schema;
use Tipoff\Waivers\Tests\TestCase;

class PermissionsMigrationTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function permissions_seeded()
    {
        $this->assertTrue(Schema::hasTable('permissions'));
        $this->assertDatabaseCount('permissions', 4);
    }
}
