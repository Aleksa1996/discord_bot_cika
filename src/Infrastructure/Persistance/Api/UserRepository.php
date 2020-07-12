<?php


namespace Discord\Infrastructure\Persistance\Api;


use Discord\Domain\Model\User;
use Discord\Domain\Repository\UserRepositoryInterface;
use Discord\Infrastructure\Http\Exception\HttpClientException;

class UserRepository extends ApiRepository implements UserRepositoryInterface
{
    /**
     * @var array
     */
    private static $endpoints = [
        'me' => '/users/@me',
        'get' => '/users/:user_id',
    ];


    /**
     * @inheritDoc
     */
    public function me()
    {
        try {

            $options = [
                'headers' => [
                    'Authorization' => 'Bot ' . $this->config->getToken(),
                    'Content-Type' => 'application/json'
                ]
            ];

            $response = $this->httpClient->request(
                'GET',
                $this->config->getApiEndpoint() . static::$endpoints['me'],
                $options
            );

            if ($response->getStatusCode() != 200) {
                return null;
            }

            $data = json_decode($response->getContent(), true);
            return $this->mapperService->map($data, User::class);
        } catch (HttpClientException $e) {
            return null;
        }
    }
}