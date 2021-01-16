<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWmtabelleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('WMTabelle', function (Blueprint $table) {
          $table->increments('WMNr');
          $table->integer('WMzugSaisonNr')->default(0);
          $table->integer('WMRunde')->default(0);
          $table->integer('WMTeamANr')->default(0);
          $table->integer('WMTeamBNr')->default(0);
          $table->integer('WMHSpNr')->default(0);
          $table->integer('WMRSpNr')->default(0);
          $table->integer('WMTAHTor')->default(0);
          $table->integer('WMTARTor')->default(0);
          $table->integer('WMTBHTor')->default(0);
          $table->integer('WMTBRTor')->default(0);
          $table->integer('WMTeamSiegerNr')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('WMTabelle');
    }
}
