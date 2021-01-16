<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamTitel extends Model
{
  // Tabelle SpielTore
  protected $table = 'teamtitel';
  // primary key
  protected $primaryKey = 'TTNr';
  //
  public $timestamps = false;
}
