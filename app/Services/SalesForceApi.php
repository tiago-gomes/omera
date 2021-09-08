<?php
  /**
   * Created by PhpStorm.
   * User: User
   * Date: 07/09/2021
   * Time: 14:24
   */
  
  namespace App\Services;
  
  use GuzzleHttp\Client;
  use Illuminate\Http\Client\Response;
  use Illuminate\Support\Arr;
  use Psr\Http\Message\ResponseInterface;
  use Symfony\Component\HttpFoundation\Response as ExceptionCode;
  
  /**
   * Class SalesForceApi
   * @package App\Services
   */
  class SalesForceApi
  {
    public static $domain = "https://force-bridge-stagining-7lcyopg5cq-ue.a.run.app";
    
    private $token;
    private Client $client;
    
    public function __construct()
    {
      $this->client = new Client(['base_uri' => self::$domain]);
    }
    
    /**
     * @return bool
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function authenticate(): bool
    {
      $response = $this->client
        ->request(
          'POST',
          '/login/',
          [
            'form_params' => config('salesforce')
          ]
        );
      
      if ($response->getStatusCode() != ExceptionCode::HTTP_OK) {
        throw new \Exception('Login Failed', ExceptionCode::HTTP_PRECONDITION_FAILED);
      }
      
      $this->setToken($response->getBody()->getContents());
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
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAllContacts(): array
    {
      $response = $this->client
        ->request(
          'GET',
          '/contacts/'
        );
      
      return $this->response($response);
    }
  
    /**
     * @param int $id
     * @return mixed
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getContactById(int $id): array
    {
      $response = $this->client
        ->request(
          'GET',
          '/contacts/' . $id
        );
      
      return $this->response($response);
    }
    
    /**
     * @param array $contact
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    public function create(array $contact): array
    {
      $response = $this->client
        ->request(
          'POST',
          '/contacts/',
          [
            'form_params' => $contact,
            'headers' => [
              'authorization' => $this->token
            ]
          ]
        );
      
      return $this->response($response);
    }
    
    /**
     * @param int $id
     * @param array $contact
     * @return array
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function update(string $id, array $contact): array
    {
      $response = $this->client
        ->request(
          'PATCH',
          '/contacts/' . $id,
          [
            'form_params' => $contact,
            'headers' => [
              'authorization' => $this->token
            ]
          ]
        );
      
      return $this->response($response);
    }
  
    /**
     * @param string $id
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    public function delete(string $id): array
    {
      $response = $this->client
        ->request(
          'DELETE',
          '/contacts/' . $id,
          [
            'headers' => [
              'authorization' => $this->token
            ]
          ]
        );
      
      return $this->response($response);
    }
    
    /**
     * @param ResponseInterface $response
     * @return array
     * @throws \Exception
     */
    private function response(ResponseInterface $response): array
    {
      if ($response->getStatusCode() != 200) {
        throw new \Exception($response->getBody()->getContents(), 400);
      }
      
      return json_decode($response->getBody()->getContents(), true);
    }
  }
