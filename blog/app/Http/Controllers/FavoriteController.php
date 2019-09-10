<?php

namespace App\Http\Controllers;

use App\Favorite;
use App\Reply;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    

    public function store(Reply $reply)
    {
        if(! $reply->favorits()->where(['user_id'=>auth()->id()])->exists()) $reply->favorits()->create(['user_id' => auth()->id(),]);
        
    }
}
