<?php
  
namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SalesForceCreateEvent
{
  use Dispatchable, InteractsWithSockets, SerializesModels;
  
  public array $payload;

  /**
   * @param array $payload
   */
  public function __construct(
    array  $payload
  )
  {
    $this->payload = $payload;
  }
}
