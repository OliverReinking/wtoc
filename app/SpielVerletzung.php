<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpielVerletzung extends Model
{
  // Tabelle SpielTore
  protected $table = 'spielverletzung';
  // primary key
  protected $primaryKey = 'SVNr';
  //
  public $timestamps = false;
}
