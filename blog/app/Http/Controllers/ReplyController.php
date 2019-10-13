<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Thread;
use Illuminate\Broadcasting\Channel;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    public function index($channel, Thread $thread)
    {
        return $thread->replies()->paginate(5);
    }
    
    public function store($channel,Thread $thread)
    {
        $reply = $thread->addReply([
            'body' => request('body'),
            'user_id' => auth()->id()
        ]);

        if(request()->expectsJson()){
            return $reply->load(['owner']);
        }

        return back()->with('flash', 'reply created successfully');
    }

    public function destroy(Reply $reply)
    {
        $this->authorize('update', $reply);
        $reply->delete();
        if(request()->expectsJson()){
            return response('reply deleted');
        }
        return back();
    }

    public function update(Reply $reply)
    {
        $this->authorize('update', $reply);
        $this->validate(request(), ['body' => 'required']);
        $reply->update(request(['body']));
    }

}
