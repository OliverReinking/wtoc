<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpielTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Spiel', function (Blueprint $table) {
            $table->increments('SpielNr');
            $table->integer('SpielTypNr')->default(0);
            $table->integer('SpielzugLandNr')->default(0);
            $table->integer('SpielzugSaisonNr')->default(0);
            $table->integer('SpielHeimTeamNr')->default(0);
            $table->integer('SpielGastTeamNr')->default(0);
            $table->text('SpielBericht');
            $table->integer('SpielHeimTore')->default(0);
            $table->integer('SpielHeimPunkte')->default(0);
            $table->integer('SpielHeimTordifferenz')->default(0);
            $table->integer('SpielGastTore')->default(0);
            $table->integer('SpielGastPunkte')->default(0);
            $table->integer('SpielGastTordifferenz')->default(0);
            $table->integer('HTaktikNr')->default(0);
            $table->integer('H02')->default(0);
            $table->integer('H03')->default(0);
            $table->integer('H04')->default(0);
            $table->integer('H05')->default(0);
            $table->integer('H06')->default(0);
            $table->integer('H07')->default(0);
            $table->integer('H08')->default(0);
            $table->integer('H09')->default(0);
            $table->integer('H10')->default(0);
            $table->integer('H11')->default(0);
            $table->integer('GTaktikNr')->default(0);
            $table->integer('G02')->default(0);
            $table->integer('G03')->default(0);
            $table->integer('G04')->default(0);
            $table->integer('G05')->default(0);
            $table->integer('G06')->default(0);
            $table->integer('G07')->default(0);
            $table->integer('G08')->default(0);
            $table->integer('G09')->default(0);
            $table->integer('G10')->default(0);
            $table->integer('G11')->default(0);
            $table->integer('HeimSpielWert')->default(0);
            $table->integer('GastSpielWert')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Spiel');
    }
}
