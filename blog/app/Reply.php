<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = ['body', 'thread_id', 'user_id'];
    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function favorits()
    {
        return $this->morphMany(Favorite::class, 'favorited');
    }
}
