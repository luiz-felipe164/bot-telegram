<?php

namespace App\Listeners;

use App\Events\DeletedChatEvent;
use Illuminate\Support\Facades\Redis;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeletedChatListener
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
     * @param  DeletedChatEvent  $event
     * @return void
     */
    public function handle(DeletedChatEvent $event)
    {
        Redis::publish('end_chat', json_encode($event->data));
    }
}
