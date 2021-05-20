<?php

declare(strict_types=1);

namespace Tipoff\Waivers\Http\Controllers\Web;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Tipoff\EscapeRoom\Models\Room;
use Tipoff\Waivers\Events\WaiverSigned;
use Tipoff\Waivers\Models\Signature;

class WaiverController extends Controller
{
    public function index()
    {
        $locations = Location::where('corporate', 1)->get();

        return view('waiver.index', [
            'locations' => $locations,
        ]);
    }

    public function show(Location $location)
    {
        $rooms = $location->rooms()->get();

        return view('waiver.show', [
            'location' => $location,
            'rooms' => $rooms,
        ]);
    }

    public function sign(Request $request)
    {
        $customMessages = [
            'approve.accepted' => 'You must agree to the terms.',
            'playing.required' => 'Please select if the parent is playing with the minors.',
            'minors.required' => 'Please add the names of all minors to the waiver.',
            'name.required' => 'Your first name is required.',
            'name_last.required' => 'Your last name is required.',
            'email.required' => 'Your email address is required to send confirmation.',
            'dob_month.required' => 'The month of your date of birth is required.',
            'dob_day.required' => 'The day of your date of birth is required.',
            'dob_year.required' => 'The year of your date of birth is required.',
            'dob_month.gt' => 'The month of your date of birth is required.',
            'dob_day.gt' => 'The day of your date of birth is required.',
            'dob_year.gt' => 'The year of your date of birth is required.',
        ];

        $request->validate([
            'approve' => 'accepted',
            'room_id' => 'required',
            'email' => 'required|email|min:3|max:900',
            'name' => 'required|min:3|max:100',
            'name_last' => 'required|min:3|max:100',
            'minors' => 'required',
            'playing' => 'required',
            'dob_month' => 'required|gt:0',
            'dob_day' => 'required|gt:0',
            'dob_year' => 'required|gt:0',
        ], $customMessages);

        $dob = Carbon::createFromDate($request->dob_year, $request->dob_month, $request->dob_day);

        // Create the signature database entry
        $signature = new Signature;
        $signature->room_id = $request->room_id;
        $signature->email_address_id = app('email_address')->findOrCreate($request->email);
        $signature->name = $request->name;
        $signature->name_last = $request->name_last;
        $signature->dob = $dob->format('Y-m-d');
        $signature->minors = $request->minors;
        $signature->minors_names = $request->minors_names;
        $signature->playing = $request->playing;
        $signature->save();

        event(new WaiverSigned($signature));
        // Event Listeners send confirmation email, create participant so will send feedback request next day. Will also need to subscribe email to newsletter.

        return response()->json(null, 200);
    }
}
