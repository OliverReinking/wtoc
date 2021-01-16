<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PokalTabelle extends Model
{
  // Tabelle Land
  protected $table = 'pokaltabelle';
  // primary key
  protected $primaryKey = 'PTNr';
  //
  public $timestamps = false;
}
