<?php
  /**
   * Created by PhpStorm.
   * User: User
   * Date: 07/09/2021
   * Time: 14:24
   */
  
  namespace App\Services;
  
  use Illuminate\Http\Client\Response;
  use Illuminate\Support\Facades\Http;
  use Illuminate\Support\Arr;
  use Symfony\Component\HttpFoundation\Response as ExceptionCode;
  
  /**
   * Class SalesForceApi
   * @package App\Services
   */
  class SalesForceApi
  {
    public static $domain = "https://force-bridge-stagining-7lcyopg5cq-ue.a.run.app/";
    
    private $token;
    
    public function __construct()
    {
      $this->client = Http::acceptJson();
    }
  
    /**
     * @return bool
     * @throws \Exception
     */
    public function authenticate(): bool
    {
      $url = self::$domain . '/login/';
      $response = $this->client
        ->post($url, config('salesforce.credentials'));
      
      if ($response->status() != ExceptionCode::HTTP_ACCEPTED) {
        throw new \Exception('Invalid credentials', ExceptionCode::HTTP_PRECONDITION_FAILED);
      }
      
      $this->setToken($response->body());
      return true;
    }
    
    /**
     * @param string $content
     */
    public function setToken(string $content)
    {
      $data = json_decode($content, true);
      $this->token = Arr::get($data, 'token');
    }
    
    
    /**
     * @return mixed
     * @throws \Exception
     */
    public function getAllContacts(): array
    {
      $url = self::$domain . '/contacts/';
      $response = $this->client
        ->withHeaders(
          [
            'Autorization' => $this->token
          ]
        )
        ->get($url, [
          "authorization" => $this->token
        ]);
      
      return $this->response($response);
    }
    
    /**
     * @param int $id
     * @return mixed
     * @throws \Exception
     */
    public function getContactById(int $id): array
    {
      $url = self::$domain . '/contacts/' . $id;
      $response = $this->client
        ->withHeaders(
          [
            'Autorization' => $this->token
          ]
        )
        ->get($url, [
          "authorization" => $this->token
        ]);
      
      return $this->response($response);
    }
    
    /**
     * @param array $contact
     * @return mixed
     * @throws \Exception
     */
    public function create(array $contact): array
    {
      $url = self::$domain . '/contacts/';
      $response = $this->client
        ->withHeaders(
          [
            'Autorization' => $this->token
          ]
        )
        ->post($url, $contact);
      
      return $this->response($response);
    }
    
    /**
     * @param int $id
     * @param array $contact
     * @return mixed
     */
    public function update(int $id, array $contact): array
    {
      $url = self::$domain . '/contacts/' . $id;
      $response = $this->client
        ->withHeaders(
          [
            'Autorization' => $this->token
          ]
        )
        ->patch($url, $contact);
      
      return $response->getBody()->getContents();
    }
    
    /**
     * @param int $id
     * @return array
     * @throws \Exception
     */
    public function delete(int $id): array
    {
      $url = self::$domain . '/contacts/' . $id;
      $response = $this->client
        ->withHeaders(
          [
            'Autorization' => $this->token
          ]
        )
        ->delete($url);
      
      return $this->response($response);
    }
    
    /**
     * @param Response $response
     * @return array
     * @throws \Exception
     */
    private function response(Response $response): array
    {
      if (!$response->ok()) {
        throw new \Exception($response->body(), 400);
      }
      
      return json_decode($response->body(), true);
    }
  }
