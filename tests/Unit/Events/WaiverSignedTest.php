<?php

declare(strict_types=1);

namespace Tipoff\Waivers\Tests\Unit\Events;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Event;
use Tipoff\Waivers\Events\WaiverSigned;
use Tipoff\Waivers\Models\Signature;
use Tipoff\Waivers\Tests\TestCase;

class WaiverSignedTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function waiver_event_fired()
    {
        Event::fake();

        $signature = Signature::factory()->create();
        event(new WaiverSigned($signature));

        Event::assertDispatched(WaiverSigned::class, function ($event) use ($signature) {
            return $event->signature->id === $signature->id;
        });
    }
}
