<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WMTabelle extends Model
{
  // Tabelle SpielTore
  protected $table = 'wmtabelle';
  // primary key
  protected $primaryKey = 'WMNr';
  //
  public $timestamps = false;
}
