<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aktion extends Model
{
  // Tabelle Aktion
  protected $table = 'aktion';
  // primary key
  protected $primaryKey = 'ANr';
  //
  public $timestamps = false;
}
