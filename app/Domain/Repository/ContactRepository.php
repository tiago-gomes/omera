<?php

    namespace App\Domain\Repository;

    use App\Domain\Repository\Contract\ContactRepositoryInterface;
    use App\Models\Contact as ContactModel;
    use Illuminate\Support\Collection;

    class ContactRepository implements ContactRepositoryInterface
    {
        /**
         * @return Collection
         */
        public function index(): Collection
        {
            return ContactModel::get();
        }

        /**
         * @param array $contact
         * @return ContactModel
         */
        public function create(array $contact): ContactModel
        {
            return ContactModel::create($contact);
        }
  
      /**
       * @param int $id
       * @param array $contact
       * @return ContactModel
       * @throws \Throwable
       */
        public function update(int $id, array $contact): ContactModel
        {
            $updated = ContactModel::findOrFail($id)->updateOrFail($contact);
            return $this->getById($id);
        }

        /**
         * @param int $id
         * @return ContactModel
         */
        public function getById(int $id): ContactModel
        {
            return ContactModel::findOrFail($id);
        }

        /**
         * @param int $id
         * @return bool
         */
        public function delete(int $id): bool
        {
            return ContactModel::findOrFail($id)->delete();
        }
    }
