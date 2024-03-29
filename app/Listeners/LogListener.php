<?php

namespace App\Listeners;

use App\Events\LogEvent;
use App\Models\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(LogEvent $event)
    {
        Log::create(['type'=>$event->type,'phone_number'=>$event->phone_number]);
    }
}
