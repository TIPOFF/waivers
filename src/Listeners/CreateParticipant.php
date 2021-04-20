<?php

namespace Tipoff\Waivers\Listeners;

use Tipoff\Support\Contracts\Booking\BookingParticipantInterface;
use Tipoff\Support\Contracts\Feedback\FeedbackInterface;
use Tipoff\Waivers\Events\WaiverSigned;

class CreateParticipant
{
    public function handle(WaiverSigned $event): void
    {
        $signature = $event->signature;

        if ($participantInterface = findService(BookingParticipantInterface::class)) {
            /** @var BookingParticipantInterface $participantInterface */
            $participant = $participantInterface::findOrCreateFromSignature($signature);

            $signature->participant_id = $participant->getId();
            $signature->save();
        }

        if ($feedbackInterface = findService(FeedbackInterface::class)) {
            /** @var FeedbackInterface $feedbackInterface */
            $feedbackInterface::createFromSignature($signature);
        }
    }
}
