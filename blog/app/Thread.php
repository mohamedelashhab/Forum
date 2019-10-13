<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{

    use RecordsActivity;

    protected $fillable = ['title', 'body', 'user_id','channel_id'];
    

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('replyCount', function($builder){
            $builder->withCount('replies');
        });

        static::deleting(function($thread){
            $thread->replies->each->delete();
        });
        
    }

    public function path()
    {
        return '/threads/'. $this->channel->slug .'/'. $this->id;
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function creator()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function addReply($reply)
    {
        return $this->replies()->create($reply);
    }

    public function channel()
    {
        return $this->belongsTo('App\Channel', 'channel_id');
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    public function subscribtions()
    {
        return $this->hasMany(ThreadSubscription::class);
    }

    public function subscribe()
    {
         $this->subscribtions()->create([
            'user_id' => auth()->id() ? : 1,  
        ]);
    }

    public function unsubscribe()
    {
        $this->subscribtions()->where('user_id', auth()->id()?:1)->delete();
    }

    public function getIsSubscribedToAttribute()
    {
        return $this->subscribtions()->where('user_id', auth()->id())->exists();
    }
}
