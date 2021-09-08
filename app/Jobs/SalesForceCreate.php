<?php
  
namespace App\Jobs;

use App\Domain\Repository\Contract\ContactRepositoryInterface;
use App\Services\SalesForceApi;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SalesForceCreate implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
  
  private array $payload;
  
  /**
   * Create a new job instance.
   *
   * @return void
   */
  public function __construct(array $payload)
  {
    $this->payload = $payload;
  }
  
  /**
   * @return array|mixed
   * @throws \Exception
   */
  public function handle()
  {
    try {
      $client = app()->get(SalesForceApi::class);
      $contactRepository = app()->get(ContactRepositoryInterface::class);
      $client->authenticate();
      $response = $client->create($this->payload);
      $this->payload = $this->mergeSalesForceExternalI($this->payload, $response);
      $contactRepository->upsert(
        $this->payload,
        [
          'email',
          'salesforce_external_id'
        ],
        $this->payload
      );
      
    } catch(\Exception $e) {
      throw new \Exception($e->getMessage(), $e->getCode());
    } catch (GuzzleException $e) {
      throw new \Exception($e->getMessage(), $e->getCode());
    }
  }
  
  /**
   * @param array $payload
   * @param array $response
   * @return array|array[]|\ArrayAccess[]|\Illuminate\Support\Carbon[]
   */
  public function mergeSalesForceExternalI(array $payload, array $response): array
  {
    return array_merge(
      $payload,
      [
        'salesforce_external_id' => \Arr::get($response, 'id'),
        'created_at' => now(),
        'updated_at' => now()
      ]
    );
  }
}
