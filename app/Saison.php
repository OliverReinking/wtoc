<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saison extends Model
{
  // Tabelle Spiel
  protected $table = 'saison';
  // primary key
  protected $primaryKey = 'SaisonNr';
  //
  public $timestamps = false;
}
