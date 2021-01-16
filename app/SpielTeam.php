<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpielTeam extends Model
{
  // Tabelle Land
  protected $table = 'spielteam';
  // primary key
  protected $primaryKey = 'SpielTeamNr';
  //
  public $timestamps = false;

}
