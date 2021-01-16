<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamKonto extends Model
{
  // Tabelle SpielTore
  protected $table = 'teamkonto';
  // primary key
  protected $primaryKey = 'TKNr';
  //
  public $timestamps = false;
}
