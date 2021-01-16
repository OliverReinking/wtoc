<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpielEreignis extends Model
{
  // Tabelle SpielTore
  protected $table = 'spielereignis';
  // primary key
  protected $primaryKey = 'SENr';
  //
  public $timestamps = false;
}
