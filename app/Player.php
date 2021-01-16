<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
  // Tabelle Player
  protected $table = 'player';
  // primary key
  protected $primaryKey = 'PlayerNr';
  //
  public $timestamps = false;
  // Ein Player gehört zu genau einem Team
  public function PlayerVonTeam()
  {
    return $this->belongsto('App\Team');
  }

}
