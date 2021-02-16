<?php

declare(strict_types=1);

namespace Tipoff\Waivers\Tests\Unit\Listeners;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Schema;
use Tipoff\Waivers\Events\WaiverSigned;
use Tipoff\Waivers\Models\Signature;
use Tipoff\Waivers\Tests\TestCase;
use Illuminate\Support\Facades\Event;

class CreateParticipantTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function participant_created()
    {
        Event::fake();

        $signature = Signature::factory()->create();
        event(new WaiverSigned($signature));

        //Todo: Need to figure out a way to assert the creation of a participant entry

        $this->assertTrue(Schema::hasTable('signatures'));
        $this->assertDatabaseCount('signatures', 1);

        //Todo: Need to figure out a way to assert the creation of a feedback entry
    }
}
