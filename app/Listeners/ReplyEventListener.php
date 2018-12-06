<?php

namespace App\Listeners;

use App\Events\ReplyEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReplyEventListener
{
    /**
     * Create the event listener.
     *
     * @d
     * wdvoid
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ReplyEvent  $event
     * @return void
     */
    public function handle(ReplyEvent $event)
    {
        //
        $user = $event->user_info;
        $user->increment('comment_count',2); //默认加1
    }
}
