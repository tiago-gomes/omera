<?php
namespace App\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class ApiDto extends DataTransferObject
{
  /** @var string|null $id */
  public ?string $salesforce_external_id;
  
  /** @var string|null $first_name */
  public ?string $first_name;
  
  /** @var string|null $last_name */
  public ?string $last_name;
  
  /** @var string|null $email */
  public ?string $email;
  
  /** @var string|null $phone */
  public ?string $phone;
  
  /** @var string|null $lead_source */
  public ?string $lead_source;
  
  /**
   * @param SalesForceDto $salesForceDto
   * @return static
   * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
   */
  public static function fromSalesForce(SalesForceDto $salesForceDto)
  {
    return new static(
      array_merge(
        $salesForceDto->toArray(),
        [
          'salesforce_external_id' => $salesForceDto->id
        ]
      )
    );
  }
}
