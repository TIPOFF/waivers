<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSignaturesTable extends Migration
{
    public function up()
    {
        Schema::create('signatures', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(app('room'))->index();
            $table->foreignIdFor(app('booking'))->nullable();
            $table->string('email');
            $table->string('name')->nullable(); // first name of adult participant or minor's supervisor
            $table->string('name_last')->nullable(); // last name of adult participant or minor's supervisor
            $table->date('dob')->nullable(); // date of birth of adult participant or minor's supervisor
            $table->string('zip')->nullable(); // zip code of adult participant or minor's supervisor
            $table->boolean('playing')->default(true); // Mark false if is parent or supervisor and not playing with minors
            $table->unsignedSmallInteger('minors'); // number of minors included on waiver
            $table->json('minors_names')->nullable(); // all names of minors inlcuded on waiver in json format.
            $table->foreignIdFor(app('image'))->nullable(); // For saving the image from the signature pad.
            $table->foreignIdFor(app('participant'))->nullable();
            $table->dateTime('emailed_at')->nullable();
            $table->boolean('valid_email')->default(true); // If email is undeliverable, need to change to false
            $table->timestamps();
        });
    }
}
