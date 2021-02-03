<?php

namespace Tipoff\Waivers\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Tipoff\Waivers\Models\Signature;

class SignatureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Signature::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'room_id'           => randomOrCreate(config('waivers.model_class.room')),
            'email'             => $this->faker->unique()->safeEmail,
            'name'              => $this->faker->name,
            'name_last'         => $this->faker->name,
            'dob'               => $this->faker->date(),
            'zip'               => $this->faker->postcode,
            'playing'           => $this->faker->boolean,
            'minors'            => $this->faker->numberBetween(1, 8),
            'image_id'          => randomOrCreate(config('waivers.model_class.image')),
            'participant_id'    => randomOrCreate(config('waivers.model_class.participant')),
            'emailed_at'        => $this->faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null),
            'valid_email'       => $this->faker->boolean,
        ];
    }
}
