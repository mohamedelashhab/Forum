<?php

namespace App\Http\Controllers;

use App\Favorite;
use App\Reply;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Reply $reply)
    {
        
        if(! $reply->favorites()->where(['user_id'=>auth()->id()])->exists()) $reply->favorites()->create(['user_id' => auth()->id(),]);

        return back();
        
    }
}
