<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Player', function (Blueprint $table) {
            $table->increments('PlayerNr');
            $table->integer('PzugTeamNr')->default(1);
            $table->string('PlayerName', 80);
            $table->string('PlayerVorName', 20);
            $table->string('PlayerNachName', 50);
            $table->string('PlayerMailadresse', 100)->nullable();
            $table->integer('PlayerTrikotNr')->default(1);
            $table->integer('PzugTypNr')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Player');
    }
}
