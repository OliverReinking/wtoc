<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Land', function (Blueprint $table) {
            $table->increments('LandNr');
            $table->string('LandName', 50);
            $table->boolean('LandChannelKZ')->default(0);
            $table->string('LandChannelID', 50)->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Land');
    }
}
