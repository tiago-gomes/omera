<?php
  
namespace App\Domain;

use App\Domain\Repository\Contract\ContactRepositoryInterface;
use App\Events\SalesForceCreateEvent;
use App\Events\SalesForceDeleteEvent;
use App\Events\SalesForceUpdateEvent;
use App\Models\Contact as ContactModel;

class ContactDomain
{
  private ContactRepositoryInterface $contactRepository;
  
  /**
   * @param ContactRepositoryInterface $contactRepository
   */
  public function __construct(
    ContactRepositoryInterface $contactRepository
  )
  {
    $this->contactRepository = $contactRepository;
  }
  
  /**
   * @return \Illuminate\Support\Collection
   */
  public function list()
  {
    return $this->contactRepository->index();
  }
  
  /**
   * @param array $contact
   * @return ContactModel
   */
  public function create(array $contact): ContactModel
  {
    $contact = $this->contactRepository->create($contact);
    SalesForceCreateEvent::dispatch($contact->toArray());
    return $contact;
  }
  
  /**
   * @param int $id
   * @param array $contact
   * @return ContactModel
   */
  public function update(int $id, array $contact): ContactModel
  {
    $contact = $this->contactRepository->update($id, $contact);
    SalesForceUpdateEvent::dispatch($contact->salesforce_external_id, $contact->toArray());
    return $contact;
  }
  
  /**
   * @param int $id
   * @return ContactModel
   */
  public function getById(int $id): ContactModel
  {
    return $this->contactRepository->getById($id);
  }
  
  /**
   * @param int $id
   * @return bool
   */
  public function delete(int $id): bool
  {
    $contact = $this->contactRepository->getById($id);
    SalesForceDeleteEvent::dispatch($contact->salesforce_external_id);
    return $this->contactRepository->delete($id);
  }
  
  public function sync()
  {
    return [];
  }
}
