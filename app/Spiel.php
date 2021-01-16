<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spiel extends Model
{
  // Tabelle Spiel
  protected $table = 'spiel';
  // primary key
  protected $primaryKey = 'SpielNr';
  //
  public $timestamps = false;
}
