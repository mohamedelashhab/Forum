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

        return redirect($thread->path());
    }

  
    public function show($channel,Thread $thread)
    {
        return view('threads.show', compact('thread'));
    }

  
    public function edit(Thread $thread)
    {
        //
    }


    public function update(Request $request, Thread $thread)
    {
        //
    }


    public function destroy(Thread $thread)
    {
        //
    }

    public function getThreads($channel, $filters)
    {
        $threads = Thread::latest()->filter($filters);
        if($channel->exists)
        {
            $threads->where('channel_id', $channel->id);
        }
  
        
        return $threads->get();

        
    }
}
