<?php

namespace Tipoff\Waivers\Listeners;

use Carbon\Carbon;
use Tipoff\Waivers\Events\WaiverSigned;

class CreateParticipant
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
        $signature = $event->signature;

        $participant = app('participant')->withTrashed()->firstOrNew(['email' => $signature->email()->email]);
        $participant->name = $signature->name;
        $participant->name_last = $signature->name_last;
        $participant->dob = $signature->dob;
        $participant->save();

        $signature->participant_id = $participant->id;
        $signature->save();

        $created = new Carbon($signature->created_at, 'UTC');
        $date = $created->setTimezone($signature->room->location->php_tz)->format('Y-m-d');
        $existing = app('feedback')->withTrashed()->where('participant_id', $participant->id)->where('location_id', $signature->room->location->id)->where('date', $date)->first();
        if (empty($existing)) {
            app('feedback')->create([
                'participant_id' => $participant->id,
                'location_id' => $signature->room->location->id,
                'date' => $date,
            ]);
        }
    }
}
