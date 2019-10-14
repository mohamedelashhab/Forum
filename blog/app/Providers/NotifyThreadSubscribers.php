<?php

namespace App\Providers;

use App\Providers\ThreadReplyAdded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyThreadSubscribers
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ThreadReplyAdded  $event
     * @return void
     */
    public function handle(ThreadReplyAdded $event)
    {
        $event->thread->notifySubscriber($event->reply);
    }
}
