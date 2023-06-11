<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FavoriteTeams extends Model
{
    //
    protected $fillable = [
                'user_id',
                'favorite_teams',
            ];

    protected $casts = [
                'favorite_teams' => 'array'
            ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }            
}
