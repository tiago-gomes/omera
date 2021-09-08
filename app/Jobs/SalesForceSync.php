<?php
  
namespace App\Jobs;

use App\Domain\Repository\Contract\ContactRepositoryInterface;
use App\DTO\ApiDto;
use App\DTO\SalesForceDto;
use App\Services\SalesForceApi;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SalesForceSync implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
  
  /**
   * Create a new job instance.
   *
   * @return void
   */
  public function __construct()
  {}
  
  /**
   * @return bool
   * @throws \Exception
   */
  public function handle()
  {
    try {
      $contactRepository = app()->get(ContactRepositoryInterface::class);
      
      $client = app()->get(SalesForceApi::class);
      $client->authenticate();
      $response = $client->getAllContacts();
      
      $contacts = \Arr::get($response, 'records');
      collect($contacts)->map(function(array $contact) use ($contactRepository) {
        $salesForceDto = new SalesForceDto($contact);
        $apiDto = ApiDto::fromSalesForce($salesForceDto);
        return $contactRepository->upsert(
          $apiDto->toArray(),
          [
            'email',
            'salesforce_external_id'
          ],
          $apiDto->toArray()
        );
      });
      
      return true;
      
    } catch(\Exception $e) {
      throw new \Exception($e->getMessage(), 400);
    } catch (GuzzleException $e) {
      throw new \Exception($e->getMessage(), 400);
    }
  }
}
