<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpielTyp extends Model
{
  // Tabelle SpielTore
  protected $table = 'spieltyp';
  // primary key
  protected $primaryKey = 'SpielTypNr';
  //
  public $timestamps = false;
}
