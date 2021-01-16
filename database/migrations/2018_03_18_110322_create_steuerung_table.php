<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSteuerungTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Steuerung', function (Blueprint $table) {
            $table->increments('SNr');
            $table->integer('SzugSaisonNr')->default(1);
            $table->integer('SzugSpieltagRunde')->default(0);
            $table->integer('SzugPokalRunde')->default(0);
            $table->integer('SzugWMRunde')->default(0);
            $table->integer('SzugAktionNr')->default(1);
            $table->string('SInfoChannelID', 50);
            $table->string('SCupChannelID', 50);
            $table->string('SWMChannelID', 50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Steuerung');
    }
}
