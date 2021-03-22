<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWaiversTable extends Migration
{
    public function up()
    {
        Schema::create('waivers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(app('location')); // Locations can have multiple waivers. Visitors will always be signing the most recently released waiver.
            $table->text('waiver')->nullable(); // Waiver agreement for the location
            $table->text('minor_statement')->nullable(); // Waiver statement for parent/legal gaurdian of minors at the location
            $table->foreignIdFor(app('user'), 'creator_id');
            $table->foreignIdFor(app('user'), 'updater_id');
            $table->dateTime('released_at');
            $table->timestamps();
        });
    }
}
