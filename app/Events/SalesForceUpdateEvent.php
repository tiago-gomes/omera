<?php
  
namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SalesForceUpdateEvent
{
  use Dispatchable, InteractsWithSockets, SerializesModels;
  
  public array $payload;
  
  public string $id;
  
  /**
   * @param string $id
   * @param array $payload
   */
  public function __construct(
    string $id,
    array  $payload
  )
  {
    $this->id = $id;
    $this->payload = $payload;
  }
}
