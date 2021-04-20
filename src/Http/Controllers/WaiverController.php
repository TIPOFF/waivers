<?php

declare(strict_types=1);

namespace Tipoff\Waivers\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Tipoff\Authorization\Models\EmailAddress;
use Tipoff\EscapeRoom\Models\Room;
use Tipoff\Locations\Models\Location;
use Tipoff\Waivers\Events\WaiverSigned;
use Tipoff\Waivers\Http\Requests\SignRequest;
use Tipoff\Waivers\Models\Signature;

class WaiverController extends Controller
{
    public function index()
    {
        $locations = Location::all();

        return view(config('waivers.views.index'), [
            'locations' => $locations,
        ]);
    }

    public function show(Location $location)
    {
        return view(config('waivers.views.show'), [
            'location' => $location,
        ]);
    }

    public function sign(SignRequest $request, Location $location)
    {
        $dob = Carbon::createFromDate($request->dob_year, $request->dob_month, $request->dob_day);

        // Create the signature database entry
        $signature = new Signature;
        $signature->room_id = $request->room_id;
        $signature->location_id = $location->id;
        $signature->email_address_id = EmailAddress::query()->firstOrCreate(['email' => $request->email]);
        $signature->first_name = $request->name;
        $signature->last_name = $request->name_last;
        $signature->dob = $dob->format('Y-m-d');
        $signature->minors = $request->minors;
        $signature->minors_names = $request->minors_names ?? null;
        $signature->playing = $request->playing;
        $signature->save();

        event(new WaiverSigned($signature));
        // Event Listeners send confirmation email, create participant so will send feedback request next day. Will also need to subscribe email to newsletter.

        return redirect(route('waiver.confirmation', ['location' => $location]));
    }

    public function confirmation(Location $location)
    {
        return view(config('waivers.views.confirmation'), [
            'location' => $location,
        ]);
    }
}
