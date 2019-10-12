<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Reply extends Model
{
    use Favoritable, RecordsActivity;
    protected $fillable = ['body', 'thread_id', 'user_id'];
    protected $with = ['favorites','owner'];

    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    public function path()
    {
        return $this->thread->path()."#reply-{$this->id}";
    }



    protected $appends = ['favoritesCount', 'isFavorited']; 

    

}
