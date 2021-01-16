<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Team', function (Blueprint $table) {
            $table->increments('TeamNr');
            $table->integer('TzugLandNr')->default(1);
            $table->string('TeamCity', 50);
            $table->string('TeamName', 50);
            $table->integer('TeamSpielplanNr')->default(1);
            $table->integer('TmAlg_Spiel')->default(1);
            $table->integer('TmAlg_Kauf')->default(1);
            $table->integer('TeamWert')->default(800);
            $table->integer('TeamKontostand')->default(500000);
            $table->integer('T02')->default(100);
            $table->integer('T03')->default(100);
            $table->integer('T04')->default(100);
            $table->integer('T05')->default(100);
            $table->integer('T06')->default(100);
            $table->integer('T07')->default(100);
            $table->integer('T08')->default(100);
            $table->integer('T09')->default(100);
            $table->integer('T10')->default(100);
            $table->integer('T11')->default(100);
            $table->boolean('TeamChannelKZ')->default(0);
            $table->string('TeamChannelID', 50)->default('0');
            $table->boolean('LieblingsmannschaftKZ')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Team');
    }
}
