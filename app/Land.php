<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Land extends Model
{
  // Tabelle Land
  protected $table = 'land';
  // primary key
  protected $primaryKey = 'LandNr';
  //
  public $timestamps = false;
  // ermittle Names des Landes: LandName
  static function ermittle_LandName($land_nr)
  {
    $landname = Land::findorfail($land_nr)->LandName;
    //
    return $landname;
  }
}
