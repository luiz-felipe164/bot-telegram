<?php

namespace App\Listeners;

use App\Events\NewMessageBotEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewMessageBotListener
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
     * @param  NewMessageBotEvent  $event
     * @return void
     */
    public function handle(NewMessageBotEvent $event)
    {
        
    }
}
