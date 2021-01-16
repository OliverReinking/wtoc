<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamkontoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TeamKonto', function (Blueprint $table) {
            $table->increments('TKNr');
            $table->integer('TKzugTeamNr')->default(0);
            $table->integer('TKzugSaisonNr')->default(0);
            $table->integer('TKWert')->default(0);
            $table->string('TKName', 50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TeamKonto');
    }
}
