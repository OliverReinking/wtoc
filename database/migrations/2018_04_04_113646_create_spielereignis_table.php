<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpielereignisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SpielEreignis', function (Blueprint $table) {
            $table->increments('SENr');
            $table->integer('SEzugSpielNr')->default(0);
            $table->integer('SEzugTeamNr')->default(0);
            $table->integer('SEzugEreignisTypNr')->default(0);
            $table->integer('SEMinute')->default(0);
            $table->string('SEBeschreibung', 500);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('SpielEreignis');
    }
}
