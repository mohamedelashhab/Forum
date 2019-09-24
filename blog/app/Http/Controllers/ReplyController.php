<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Thread;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store($channel,Thread $thread)
    {
        $thread->addReply([
            'body' => request('body'),
            'user_id' => auth()->id()
        ]);

        return back()->with('flash', 'reply created successfully');
    }

    public function destroy(Reply $reply)
    {
        $this->authorize('update', $reply);
        $reply->delete();
        return back();
    }
}
