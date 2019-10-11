<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Filters\ThreadFilters;
use App\Thread;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    
    public function index(Channel $channel, ThreadFilters $filters)
    {
        
        $threads = $this->getThreads($channel, $filters);
        return view('threads.index', compact('threads'));
    }


    public function create()
    {
        return view('threads.create');
    }

   
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'channel_id' => 'required|exists:channels,id'
        ]);
        
        $thread = Thread::create([
            'user_id' => auth()->id(),
            'title' => request('title'),
            'body' => request('body'),
            'channel_id' => request('channel_id')
        ]);

        return redirect($thread->path())->with('flash', 'Thread created successfully');
    }

  
    public function show(Channel $channel, Thread $thread)
    {
        return view('threads.show', [
            'thread' => $thread,
            'replies' => $thread->replies()->get(),
        ]);
    }

  
    public function edit(Thread $thread)
    {
        
    }


    public function update(Request $request, Thread $thread)
    {
        
    }


    public function destroy(Channel $channel, Thread $thread)
    {
        $this->authorize('update' , $thread);
        $thread->delete();
        if(request()->wantsJson())
        {
            return response([], 204);
        }

        return redirect('/threads');
    }

    public function getThreads($channel, $filters)
    {
        $threads = Thread::with('channel')->latest()->filter($filters);
        if($channel->exists)
        {
            $threads->where('channel_id', $channel->id);
        }
  
        return $threads->get();
    }
}
