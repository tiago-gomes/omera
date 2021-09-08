<?php
namespace App\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class SalesForceDto extends DataTransferObject
{
  /** @var string|null $id */
  public ?string $id;
  
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
}
