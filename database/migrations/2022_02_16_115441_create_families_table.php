<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamiliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('families', function (Blueprint $table) {
            $table->id();
            $table->string('nachname');
            $table->string('vorname');
            $table->date('geburtsdatum')->nullable();
            $table->string('geburtsjahr')->nullable();
            // $table->foreign('geburtsort')->references('ort_id')->on('orts');
            $table->string('geburtsort')->nullable();
            $table->date('heiratsdatum')->nullable();
            $table->string('heiratsjahr')->nullable();
            // $table->foreign('heiratsort')->references('ort_id')->on('orts');
            $table->string('heiratsort')->nullable;
            $table->date('sterbedatum')->nullable();
            $table->string('sterbejahr')->nullable();
            $table->string('sterbeort')->nullable();
            $table->string('taufdatum')->nullable();
            // $table->foreign('taufort')->references('ort_id')->on('orts');
            $table->string('taufort')->nullable();
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
        Schema::dropIfExists('families');
    }
}
