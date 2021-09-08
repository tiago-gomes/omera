<?php
  
namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SalesForceDeleteEvent
{
  use Dispatchable, InteractsWithSockets, SerializesModels;
  
  public array $payload;
  
  public string $id;
  
  /**
   * @param int $id
   */
  public function __construct(
    string $id
  )
  {
    $this->id = $id;
  }
}
