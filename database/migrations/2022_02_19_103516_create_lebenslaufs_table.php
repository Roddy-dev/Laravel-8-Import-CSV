<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLebenslaufsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lebenslaufs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->references('id')->on('families');
            // $table->foreignId('familie_id')->on('families');
            $table->string('tag')->nullable();
            $table->string('monat')->nullable();
            $table->string('jahr')->nullable();
            // $table->string('lebenslaufdate')->nullable();
            $table->string('beschreibung')->nullable();
            $table->string('dokument')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lebenslaufs');
    }
}
