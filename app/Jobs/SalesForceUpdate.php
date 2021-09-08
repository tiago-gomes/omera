<?php

namespace App\Jobs;

use App\Services\SalesForceApi;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SalesForceUpdate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
  
  private string $externalId;
  
  private array $payload;
  
  /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $externalId, array $payload)
    {
        $this->externalId =  $externalId;
        $this->payload = $payload;
    }
  
  /**
   * @return array|mixed
   * @throws \Exception
   */
    public function handle(): mixed
    {
      try {
        $client = app()->get(SalesForceApi::class);
        $client->authenticate();
        $client->update($this->externalId, $this->payload);
        return true;
      } catch(\Exception $e) {
        throw new \Exception($e->getMessage(), $e->getCode());
      } catch (GuzzleException $e) {
      }
    }
}
