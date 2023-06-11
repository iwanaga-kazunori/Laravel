<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tester extends Model
{
    //
    public function testphone()
    {
        return $this->hasOne('App\Testphone');
    }
}
