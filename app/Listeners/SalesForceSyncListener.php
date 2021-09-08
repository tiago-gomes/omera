<?php

namespace App\Listeners;

use App\Events\SalesForceSyncEvent;
use App\Jobs\SalesForceSync;

class SalesForceSyncListener
{
  /**
   * @param SalesForceSyncEvent $event
   */
    public function handle(SalesForceSyncEvent $event)
    {
      SalesForceSync::dispatch();
    }
}
