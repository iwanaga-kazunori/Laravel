<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testphone extends Model
{
    //
    public function tester()
    {
        return $this->belongsTo('App\Tester');
    }
}
