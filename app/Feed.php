<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    //
    protected $guarded = array('id');

    protected $table = 'feed';

    public static $rules = array(
        'title' => 'required',
        'body' => 'required',
    );

    public function comments() {
        return $this->hasMany('App\FeedComment', 'news_id', 'news_id');
    }

    public function teammaster()
    {
        return $this->hasOne('App\Team', 'team_name_ja', 'team');
    }
}
