<?php

declare(strict_types=1);

namespace Tipoff\Waivers\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Tipoff\Locations\Models\Location;
use Tipoff\Waivers\Models\Waiver;

class WaiverFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Waiver::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @throws \Exception
     */
    public function definition()
    {
        return [
            'location_id' => randomOrCreate(Location::class),
            'creator_id'  => randomOrCreate(app('user')),
            'updater_id'  => randomOrCreate(app('user'))
        ];
    }
}
