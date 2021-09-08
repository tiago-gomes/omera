<?php
  
  namespace Tests\Unit;
  
  use App\Domain\ContactDomain;
  use App\Models\Contact;
  use Mockery\Instantiator;
  use Mockery\MockInterface;
  use PHPUnit\Framework\TestCase;
  
  class ContactDomainTest extends TestCase
  {
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testContactDomain()
    {
      $contact = [
        'first_name' => 'tiago',
        'last_name' => 'gomes',
        'email' => 'geone2385@gmail.com'
      ];
      $newRecord = array_merge(
        $contact,
        ['id' => 1]
      );

      $this->prepareBinding($contact, $newRecord);
      
      $contactDomain = app()->get(ContactDomain::class);
      $response = $contactDomain->create($contact);
      
      $this->assertIsArray($response->toArray());
    }
    
    /**
     * @param array $contact
     * @param $newRecord
     */
    public function prepareBinding(array $contact, $newRecord)
    {
      app()->instance(
        ContactDomain::class,
        \Mockery::mock(ContactDomain::class, function (MockInterface $mock) use ($contact, $newRecord) {
          $mock->shouldReceive('create')
            ->once()
            ->with($contact)
            ->andReturn(new Contact($newRecord));
        })
      );
    }
  }
