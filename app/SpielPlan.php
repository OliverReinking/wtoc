<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpielPlan extends Model
{
  // Tabelle SpielPlan
  protected $table = 'spielplan';
  // primary key
  protected $primaryKey = 'SpielplanNr';
  //
  public $timestamps = false;
}
