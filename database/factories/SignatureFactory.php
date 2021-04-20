<?php

declare(strict_types=1);

namespace Tipoff\Waivers\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Tipoff\Waivers\Models\Signature;

class SignatureFactory extends Factory
{
    protected $model = Signature::class;

    public function definition()
    {
        return [
            'room_id'           => randomOrCreate(app('room')),
            'location_id'       => randomOrCreate(app('location')),
            'email_address_id'  => randomOrCreate(app('email_address')),
            'first_name'        => $this->faker->name,
            'last_name'         => $this->faker->name,
            'zip_code'          => randomOrCreate(app('zip')),
            'dob'               => $this->faker->date(),
            'playing'           => $this->faker->boolean,
            'minors'            => $this->faker->numberBetween(1, 8),
            'image_id'          => randomOrCreate(app('image')),
            'participant_id'    => randomOrCreate(app('participant')),
            'emailed_at'        => $this->faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null),
        ];
    }
}
