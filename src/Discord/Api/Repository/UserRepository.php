<?php


namespace Discord\Discord\Api\Repository;


use Discord\Discord\Exception\HttpClientException;

class UserRepository extends AbstractRepository
{
    protected $endpoints = [
        'get' => '/users/:id',
        'get_current' => '/users/@me',
        'create' => '/users',
        'update' => '/users/:id',
        'delete' => '/users/:id',
    ];

    /**
     * @return mixed
     *
     * @throws HttpClientException
     */
    public function me()
    {
        $url = $this->getEndpoint('get_current');
        $request = $this->buildRequest('GET', $url);

        return $this->http->request($request);
    }
}