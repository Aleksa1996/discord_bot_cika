<?php


namespace Discord\Discord\Api\Repository;


use Discord\Discord\Api\Http\AbstractHttpClient;
use Discord\Discord\Api\Http\Request;
use Discord\Discord\Helper\Url;

abstract class AbstractRepository
{
    /**
     * Base API endpoint
     *
     * @var string
     */
    protected $baseEndpoint;

    /**
     * @var array
     */
    protected $endpoints;

    /**
     * @var string
     */
    protected $token;

    /**
     * Http
     *
     * @var AbstractHttpClient
     */
    protected $http;

    /**
     * AbstractResource constructor.
     *
     * @param string $baseEndpoint
     * @param string $token
     * @param AbstractHttpClient $http
     */
    public function __construct(string $baseEndpoint, string $token, AbstractHttpClient $http)
    {
        $this->baseEndpoint = $baseEndpoint;
        $this->token = $token;
        $this->http = $http;
    }

    /**
     * Get all defined endpoints
     *
     * @return array
     */
    public function getEndpoints(): array
    {
        return $this->endpoints;
    }

    /**
     * Get single endpoint
     *
     * @param $key
     * @param array $params
     *
     * @return string|null
     */
    public function getEndpoint($key, $params = [])
    {
        if (isset($this->endpoints[$key])) {
            return $this->baseEndpoint . Url::replaceParams($this->endpoints[$key], $params);
        }

        return null;
    }

    /**
     * Set endpoints
     *
     * @param array $endpoints
     *
     * @return AbstractRepository
     */
    public function setEndpoints(array $endpoints)
    {
        $this->endpoints = $endpoints;

        return $this;
    }

    /**
     * Set single endpoint
     *
     * @param $key
     * @param $value
     *
     * @return AbstractRepository
     */
    public function setEndpoint($key, $value)
    {
        $this->endpoints[$key] = $value;

        return $this;
    }

    /**
     * Request builder
     *
     * @param $method
     * @param $url
     * @param $body
     *
     * @return Request
     */
    public function buildRequest($method, $url, $body)
    {
        $request = new Request($method, $url, $body);
        $request->addHeader('Authorization', sprintf('Bot %s', $this->token));
        var_dump($body);
        return $request;
    }

}