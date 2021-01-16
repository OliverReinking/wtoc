<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
  // Tabelle Team
  protected $table = 'team';
  // primary key
  protected $primaryKey = 'TeamNr';
  //
  public $timestamps = false;
  // 
  public function country()
  {
    return $this->belongsTo('App\Land', 'TzugLandNr', 'LandNr');
  }
  // ermittle Names des Teams: TeamCity
  static function ermittle_TeamCity($team_nr)
  {
    $teamcity = Team::findorfail($team_nr)->TeamCity;
    //
    return $teamcity;
  }

}
