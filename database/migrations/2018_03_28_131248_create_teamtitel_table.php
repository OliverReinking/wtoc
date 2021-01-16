<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamtitelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TeamTitel', function (Blueprint $table) {
            $table->increments('TTNr');
            $table->integer('TTzugTeamNr')->default(0);
            $table->integer('TTzugSaisonNr')->default(0);
            $table->integer('TTzugLandNr')->default(0);
            $table->integer('TTTitelTypNr')->default(0);
            $table->string('TTName', 50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TeamTitel');
    }
}
