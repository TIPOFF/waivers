<?php

declare(strict_types=1);

namespace Tipoff\Waivers\Tests\Unit\Http\Controllers;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\Locations\Models\Location;
use Tipoff\Waivers\Tests\TestCase;

class WaiversControllerTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function index()
    {
        $this->logToStderr();
        Location::factory()->count(3)->create();

        $this->get(route('waiver.index'))
            ->assertOk()
            ->assertSee("-- L:3 --");
    }

    /** @test */
    public function show()
    {
        $location = Location::factory()->create();

        $this->get(route('waiver.form', [ 'location' => $location ]))
            ->assertOk()
            ->assertSee("-- L:{$location->id} --");
    }

    /** @test */
    public function sign_valid()
    {
        $this->logToStderr();

        $room = app('room')->factory()->create();
        $location = Location::factory()->create();

        $this->post(route('waiver.sign', [ 'location' => $location ]), [
            'approve' => 1,
            'room_id' => $room->id,
            'email' => 'example@email.com',
            'name' => 'First',
            'name_last' => 'Last',
            'minors' => 0,
            'playing' => 1,
            'dob_month' => 1,
            'dob_day' => 1,
            'dob_year' => 2000,
        ])
            ->assertRedirect(route('waiver.confirmation', ['location' => $location]));
    }

    /** @test */
    public function sign_invalid()
    {
        $location = Location::factory()->create();

        $response = $this->post(route('waiver.sign', [ 'location' => $location ]), [

        ])
            ->assertSessionHasErrors([
                'approve' => 'You must agree to the terms.',
                'room_id' => 'The room id field is required.',
                'email' => 'Your email address is required to send confirmation.',
                'name' => 'Your first name is required.',
                'name_last' => 'Your last name is required.',
                'minors' => 'Please add the names of all minors to the waiver.',
                'playing' => 'Please select if the parent is playing with the minors.',
                'dob_month' => 'The month of your date of birth is required.',
                'dob_day' => 'The day of your date of birth is required.',
                'dob_year' => 'The year of your date of birth is required.',
            ]);
    }

    /** @test */
    public function confirmation()
    {
        $this->logToStderr();

        $location = Location::factory()->create();

        $this->get(route('waiver.confirmation', [
            'location' => $location,
        ]))
            ->assertOk()
            ->assertSee("-- L:{$location->id} --");
    }
}
