<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpieltoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SpielTore', function (Blueprint $table) {
            $table->increments('SpielToreNr');
            $table->integer('SpielTorezugSpielNr')->default(0);
            $table->integer('SpielTorezugLandNr')->default(0);
            $table->integer('SpielTorezugTeamNr')->default(0);
            $table->integer('SpielTorezugSaisonNr')->default(0);
            $table->integer('SpielTorezugSpieltypNr')->default(0);
            $table->integer('SpielTorezugPlayerNr')->default(0);
            $table->integer('SpielToreMinute')->default(0);
            $table->integer('SpielToreTyp')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('SpielTore');
    }
}
