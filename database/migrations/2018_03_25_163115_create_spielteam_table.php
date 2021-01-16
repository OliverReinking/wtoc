<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpielteamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SpielTeam', function (Blueprint $table) {
            $table->increments('SpielTeamNr');
            $table->integer('STzugSpielNr')->default(0);
            $table->integer('STzugSaisonNr')->default(0);
            $table->integer('STzugTeamNr')->default(0);
            $table->integer('STTypNr')->default(0);
            $table->integer('STW02')->default(0);
            $table->integer('STW03')->default(0);
            $table->integer('STW04')->default(0);
            $table->integer('STW05')->default(0);
            $table->integer('STW06')->default(0);
            $table->integer('STW07')->default(0);
            $table->integer('STW08')->default(0);
            $table->integer('STW09')->default(0);
            $table->integer('STW10')->default(0);
            $table->integer('STW11')->default(0);
            $table->integer('STTaktikNr')->default(0);
            $table->integer('STTeamwert')->default(0);
            $table->integer('STSpielwert')->default(0);
            $table->integer('STTore')->default(0);
            $table->integer('STGegenTore')->default(0);
            $table->integer('STPunkte')->default(0);
            $table->integer('STGegnerTeamwert')->default(0);
            $table->integer('STGegnerSpielwert')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('SpielTeam');
    }
}
