<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Tipoff\Locations\Models\Location;

class CreateWaiversTable extends Migration
{
    public function up()
    {
        Schema::create('waivers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Location::class)->unique();	// NOTE - unique() added -- there should be exactly one record per location!
            $table->text('waiver')->nullable(); // Waiver agreement for the location
            $table->text('minor_statement')->nullable(); // Waiver statement for parent/legal gaurdian of minors at the location
            $table->foreignIdFor(app('user'), 'creator_id');
            $table->foreignIdFor(app('user'), 'updater_id');
            $table->timestamps();
        });
    }
}
