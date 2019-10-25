<?php

namespace App\Http\Controllers;

use App\Inspections\Spam;
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
       


        try{   

            request()->validate([
                'body' => 'required|spamfree',
            ]);

            $this->spam->detect(request('body'));

            $reply = $thread->addReply([
                'body' => request('body'),
                'user_id' => auth()->id()
            ]);

            return $reply->load('owner');

    
        }catch(\Exception $e)
        {

            return response()->json("your reply contains spam", 422);
        }

    
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
        
        try{
            $this->authorize('update', $reply);
            $this->validate(request(), ['body' => 'required|spamfree']);
            // $this->spam->detect(request('body'));
            $reply->update(request(['body']));
        }catch(\Exception $e){
            return response()->json("Sorry, your reply could not be saved at this time", 422);
        }
        
        
    }

}
