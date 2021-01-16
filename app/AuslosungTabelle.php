<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuslosungTabelle extends Model
{
  // Tabelle AuslosungTabelle
  protected $table = 'auslosungtabelle';
  // primary key
  protected $primaryKey = 'ATNr';
  //
  public $timestamps = false;
}
