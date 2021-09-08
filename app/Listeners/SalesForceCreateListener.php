<?php

namespace App\Listeners;

use App\Events\SalesForceCreateEvent;
use App\Jobs\SalesForceCreate;

class SalesForceCreateListener
{
  /**
   * @param SalesForceCreateEvent $event
   * @return bool
   * @throws \Exception
   */
    public function handle(SalesForceCreateEvent $event)
    {
      SalesForceCreate::dispatch( $event->payload);
    }
}
