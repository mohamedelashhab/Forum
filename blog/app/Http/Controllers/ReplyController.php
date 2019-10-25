<?php

namespace App\Http\Controllers;

use App\Inspections\Spam;
use App\Reply;
use App\Thread;
use Illuminate\Broadcasting\Channel;
use Illuminate\Http\Request;

class ReplyController extends Controller
{

    private $spam;
    public function __construct(Spam $spam)
    {
        $this->middleware('auth')->except('index');
        $this->spam = $spam;
    }

    public function index($channel, Thread $thread)
    {
        return $thread->replies()->paginate(5);
    }
    
    public function store($channel,Thread $thread)
    {
        request()->validate([
            'body' => 'required',
        ]);

    $this->spam->detect(request('body'))

        $reply = $thread->addReply([
            'body' => request('body'),
            'user_id' => auth()->id()
        ]);

        if(request()->expectsJson()){
            return $reply->load('owner');
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
        $this->spam->detect(request('body'));
        $reply->update(request(['body']));
    }

}
