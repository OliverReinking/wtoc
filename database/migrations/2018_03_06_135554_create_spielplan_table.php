<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpielplanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Spielplan', function (Blueprint $table) {
            $table->increments('SpielplanNr');
            $table->integer('SpieltagNr')->default(1);
            $table->integer('HeimNr')->default(1);
            $table->integer('GastNr')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Spielplan');
    }
}
