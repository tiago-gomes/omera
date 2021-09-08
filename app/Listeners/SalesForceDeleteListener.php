<?php

namespace App\Listeners;

use App\Events\SalesForceDeleteEvent;
use App\Jobs\SalesForceDelete;

class SalesForceDeleteListener
{
  /**
   * @param SalesForceDeleteEvent $event
   * @return bool
   */
    public function handle(SalesForceDeleteEvent $event)
    {
      SalesForceDelete::dispatch($event->id);
    }
}
