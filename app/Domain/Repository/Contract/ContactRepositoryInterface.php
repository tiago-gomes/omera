<?php

namespace App\Domain\Repository\Contract;

use App\Models\Contact as ContactModel;
use Illuminate\Support\Collection;

interface ContactRepositoryInterface
{
    /**
     * @return Collection
     */
    public function index(): Collection;

    /**
     * @param array $contact
     * @return ContactModel
     */
    public function create(array $contact): ContactModel;
  
  /**
   * @param array $contact
   * @param array $keys
   * @param array $values
   * @return bool
   */
  public function upsert(array $contact, array $keys, array $values):bool;

    /**
     * @param int $id
     * @param array $contact
     * @return ContactModel
     */
    public function update(int $id, array $contact): ContactModel;

    /**
     * @param int $id
     * @return ContactModel
     */
    public function getById(int $id): ContactModel;

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}
