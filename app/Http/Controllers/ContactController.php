<?php
/**
 * Created by PhpStorm.
 * User: Tiago Gomes
 * Date: 07/09/2021
 * Time: 14:22
 */

namespace App\Http\Controllers;

use App\Domain\ContactDomain;
use App\Http\Requests\CreateContact;
use App\Http\Requests\UpdateContact;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as HttpCode;

class ContactController
{
  private ContactDomain $contactDomain;
  
  /**
   * @param ContactDomain $contactDomain
   */
  public function __construct(
    ContactDomain $contactDomain
  )
  {
    $this->contactDomain = $contactDomain;
  }
  
  /**
   * @return JsonResponse
   */
  public function index(): JsonResponse
  {
    return $this->response($this->contactDomain->list()->toArray());
  }
  
  /**
   * @param CreateContact $request
   * @return JsonResponse
   */
  public function store(CreateContact $request): JsonResponse
  {
    $contact = $this->contactDomain->create($request->validated());
    return $this->response($contact->toArray());
  }
  
  /**
   * @param int $id
   * @param UpdateContact $request
   * @return JsonResponse
   */
  public function update(int $id, UpdateContact $request): JsonResponse
  {
    $contact = $this->contactDomain->update($id, $request->validated());
    return $this->response($contact->toArray());
  }
  
  /**
   * @param int $id
   * @return JsonResponse
   */
  public function read(int $id): JsonResponse
  {
    $contact = $this->contactDomain->getById($id);
    return $this->response($contact->toArray());
  }
  
  /**
   * @param int $id
   * @return JsonResponse
   * @throws \Exception
   */
  public function delete(int $id): JsonResponse
  {
    $contactDeleted = $this->contactDomain->delete($id);
    if (!$contactDeleted) {
      throw new \Exception('Entity not deleted', HttpCode::HTTP_UNPROCESSABLE_ENTITY);
    }
    return $this->response(['ok']);
  }
  
  /**
   * @return JsonResponse
   */
  public function sync(): JsonResponse
  {
    $this->contactDomain->sync();
    return $this->response(['ok']);
  }
  
  /**
   * todo: move this to a trait
   *
   * @param array $response
   * @return JsonResponse
   */
  private function response(array $response): JsonResponse
  {
    return response()->json([
      'data' => $response
    ], HttpCode::HTTP_OK);
  }
}
