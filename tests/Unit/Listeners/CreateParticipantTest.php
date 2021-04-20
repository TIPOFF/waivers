<?php

declare(strict_types=1);

namespace Tipoff\Waivers\Tests\Unit\Listeners;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Schema;
use Tipoff\Support\Contracts\Booking\BookingParticipantInterface;
use Tipoff\Support\Contracts\Feedback\FeedbackInterface;
use Tipoff\Waivers\Events\WaiverSigned;
use Tipoff\Waivers\Models\Signature;
use Tipoff\Waivers\Tests\TestCase;

class CreateParticipantTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function waiver_signed_no_services()
    {
        $signature = Signature::factory()->create();
        event(new WaiverSigned($signature));

        $this->assertTrue(Schema::hasTable('signatures'));
        $this->assertDatabaseCount('signatures', 1);
    }

    /** @test */
    public function waiver_signed_with_participant_services()
    {
        $service = \Mockery::mock(BookingParticipantInterface::class);
        $service->shouldReceive('findOrCreateFromSignature')->once()->andReturnSelf();
        $service->shouldReceive('getId')->once()->andReturn(123);
        $this->app->instance(BookingParticipantInterface::class, $service);

        $signature = Signature::factory()->create();
        event(new WaiverSigned($signature));
    }

    /** @test */
    public function waiver_signed_with_feedback_services()
    {
        $service = \Mockery::mock(FeedbackInterface::class);
        $service->shouldReceive('createFromSignature')->once()->andReturnSelf();
        $this->app->instance(FeedbackInterface::class, $service);

        $signature = Signature::factory()->create();
        event(new WaiverSigned($signature));
    }
}
