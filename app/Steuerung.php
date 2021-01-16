<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Steuerung extends Model
{
  // Tabelle SpielTore
  protected $table = 'steuerung';
  // primary key
  protected $primaryKey = 'SNr';
  //
  public $timestamps = false;
}
