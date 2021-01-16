<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpielverletzungTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SpielVerletzung', function (Blueprint $table) {
          $table->increments('SVNr');
          $table->integer('SVzugSpielNr')->default(0);
          $table->integer('SVzugLandNr')->default(0);
          $table->integer('SVzugTeamNr')->default(0);
          $table->integer('SVzugSaisonNr')->default(0);
          $table->integer('SVzugSpieltypNr')->default(0);
          $table->integer('SVTeamreduktionswert')->default(0);
          $table->integer('SVMinute')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('SpielVerletzung');
    }
}
