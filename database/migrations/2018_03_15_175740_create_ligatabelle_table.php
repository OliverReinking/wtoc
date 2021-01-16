<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLigatabelleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('LigaTabelle', function (Blueprint $table) {
          $table->increments('LTNr');
          $table->integer('LTzugLandNr')->default(1);
          $table->integer('LTzugSaisonNr')->default(1);
          $table->integer('LTSpieltag')->default(1);
          $table->integer('LTPlatz')->default(1);
          $table->integer('LTzugTeamNr')->default(1);
          $table->integer('LTAnzahlSiege')->default(1);
          $table->integer('LTAnzahlUnentschieden')->default(1);
          $table->integer('LTAnzahlNiederlagen')->default(1);
          $table->integer('LTPlusPunkte')->default(1);
          $table->integer('LTPlusTore')->default(1);
          $table->integer('LTMinusTore')->default(1);
          $table->integer('LTTorDifferenz')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('LigaTabelle');
    }
}
