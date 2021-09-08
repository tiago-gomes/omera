<?php

namespace App\Listeners;

use App\Events\SalesForceUpdateEvent;
use App\Jobs\SalesForceUpdate;

class SalesForceUpdateListener
{
  /**
   * @param SalesForceUpdateEvent $event
   * @return bool
   */
    public function handle(SalesForceUpdateEvent $event)
    {
        SalesForceUpdate::dispatch($event->id, $event->payload);
    }
}
