<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerweisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verweises', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id');
            $table->unsignedBigInteger('zu_person_id')->nullable();
            $table->string('katagorie');
            $table->string('beschreibung');

            $table->foreign('person_id')
                ->references('id')
                ->on('families');

            $table->foreign('zu_person_id')
                ->references('id')
                ->on('families')
                ->nullOnDelete();
                
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
        Schema::dropIfExists('verweises');
    }
}
