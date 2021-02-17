<?php

namespace Tipoff\Waivers\Listeners;

use Tipoff\Waivers\Events\WaiverSigned;

class SendWaiverConfirmation
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  WaiverSigned  $event
     * @return void
     */
    public function handle(WaiverSigned $event)
    {
        // $signature = $event->signature;

        // Mail::send(new WaiverConfirmation($signature));

        // $signature->emailed_at = Carbon::now();
        // $signature->save();
    }
}
