<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Thread;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    
    public function index(Channel $channel)
    {
        if($channel->exists)
        {
            $threads = $channel->threads()->latest();
        }
        else
        {
            $threads = Thread::latest();
        }

        //request('by')
        if($username = request('by'))
        {
            $user = \App\User::where('name', $username)->firstOrFail();
            $threads->where('user_id', $user->id);
        }
        
        $threads = $threads->get();
        
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
}
