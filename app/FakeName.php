<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FakeName extends Model
{
  // Tabelle FakeName
  protected $table = 'fakename';
  // primary key
  protected $primaryKey = 'Nr';
  //
  public $timestamps = false;
}
