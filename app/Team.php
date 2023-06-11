<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    //
    protected $guarded = array('id');

    public static $rules = array(
        'team_name_ja' => 'required',
        'team_name_de' => 'required',
        'path' => 'required',
        'file_name' => 'required',
    );
}
