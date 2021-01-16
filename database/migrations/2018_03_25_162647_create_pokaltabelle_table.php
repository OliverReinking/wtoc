<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePokaltabelleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PokalTabelle', function (Blueprint $table) {
            $table->increments('PTNr');
            $table->integer('PTzugSaisonNr')->default(0);
            $table->integer('PTRunde')->default(0);
            $table->integer('PTTeamANr')->default(0);
            $table->integer('PTTeamBNr')->default(0);
            $table->integer('PTHSpNr')->default(0);
            $table->integer('PTRSpNr')->default(0);
            $table->integer('PTTAHTor')->default(0);
            $table->integer('PTTARTor')->default(0);
            $table->integer('PTTBHTor')->default(0);
            $table->integer('PTTBRTor')->default(0);
            $table->integer('PTTeamSiegerNr')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('PokalTabelle');
    }
}
