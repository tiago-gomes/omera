<?php
    /**
     * Created by PhpStorm.
     * User: User
     * Date: 07/09/2021
     * Time: 14:22
     */

    namespace App\Http\Controllers;

    use App\Domain\ContactDomain;
    use Illuminate\Http\JsonResponse;
    use \Illuminate\Support\Facades\Request;
    use Symfony\Component\HttpFoundation\Response as ExceptionCode;

    class ContactController
    {
        public function __construct(
            ContactDomain $contactDomain
        ) {
            $this->contactDomain = $contactDomain;
        }

        public function index()
        {
            return $this->response($this->contactDomain->list()->toArray());
        }

        public function store(Request $request)
        {
            $contact = $this->contactDomain->create($request->toArray());
            return $this->response($contact);
        }

        public function update(int $id, Request $request)
        {
            $contact = $this->contactDomain->update($id, $request->toArray());
            return $this->response($contact);
        }

        public function read(int $id)
        {
            $contact = $this->contactDomain->getById($id);
            return $this->response($contact);
        }

        public function delete(int $id)
        {
            $contactDeleted = $this->contactDomain->delete($id);
            if (!$contactDeleted)
            {
                throw new \Exception('Entity not deleted', ExceptionCode::HTTP_UNPROCESSABLE_ENTITY);
            }
            return $this->response(['ok']);
        }

        public function sync()
        {

        }

        /**
         * @param array $response
         * @return JsonResponse
         */
        private function response(array $response): JsonResponse
        {
            return response()->json([
                'data' => $response
            ], 200);
        }
    }
