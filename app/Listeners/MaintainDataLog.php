<?php

namespace App\Listeners;

use App\Events\MoviesFetchedFromCache;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class MaintainDataLog
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
     * @param  \App\Events\MoviesFetchedFromCache  $event
     * @return void
     */
    public function handle(MoviesFetchedFromCache $event)
    {
        Log::info($event->logMessage);
    }
}
