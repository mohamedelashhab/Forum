<?php

namespace App;

trait Favoritable
{

    protected static function bootFavoritable(){
        static::deleting(function($model){
            $model->favorites->each->delete();
        });
    }
    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favorited');
    }

    public function isFavorited()
    {
        return !! $this->favorites()->where('user_id', auth()->id())->count();
    }

    public function getFavoritesCountAttribute()
    {
        return $this->favorites->count();
    }

    public function getIsFavoritedAttribute(){
        return $this->isFavorited();
    }

    public function unfavorite(){
        $this->favorites()->where(['user_id' => auth()->id()])->get()->each->delete();
    }
 
}