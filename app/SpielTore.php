<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpielTore extends Model
{
    // Tabelle SpielTore
    protected $table = 'spieltore';
    // primary key
    protected $primaryKey = 'SpielToreNr';
    //
    public $timestamps = false;
}
