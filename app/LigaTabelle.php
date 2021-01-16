<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LigaTabelle extends Model
{
    // Tabelle LigaTabelle
    protected $table = 'ligatabelle';
    // primary key
    protected $primaryKey = 'LTNr';
    //
    public $timestamps = false;
}
