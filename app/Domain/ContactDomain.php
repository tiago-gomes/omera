<?php

    namespace App\Domain;

    use App\Domain\Repository\Contract\ContactRepositoryInterface;
    use App\Models\Contact as ContactModel;

    class ContactDomain
    {
        private ContactRepositoryInterface $contactRepository;
    
        /**
         * @param ContactRepositoryInterface $contactRepository
         */
        public function __construct(
            ContactRepositoryInterface $contactRepository
        ){
            $this->contactRepository = $contactRepository;
        }
    
        /**
         * @return \Illuminate\Support\Collection
         */
        public function list()
        {
            return $this->contactRepository->index();
        }

        public function create(array $contact): ContactModel
        {
            return $this->contactRepository->create($contact);
        }
    
        /**
         * @param int $id
         * @param array $contact
         * @return \App\Models\Contact
         */
        public function update(int $id, array $contact): ContactModel
        {
            return $this->contactRepository->update($id, $contact);
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
            return $this->contactRepository->delete($id);
        }

        public function sync()
        {
            return [];
        }
    }
