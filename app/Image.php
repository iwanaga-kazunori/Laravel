<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    protected $guarded = array('image_id');

    // 以下を追記
    public static $rules = array(
        'path' => 'required',
        'image_name' => 'required',
    );
}
