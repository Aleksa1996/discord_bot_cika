<?php


namespace Discord\Discord\Api\Resource;


use Discord\Discord\Api\Http\AbstractHttpClient;
use Discord\Discord\Api\Repository\AbstractRepository;

abstract class AbstractResource
{
    /**
     * Holds API response data
     *
     * @var array
     */
    protected $data = [];

    /**
     * Http
     *
     * @var AbstractHttpClient
     */
    protected $http = [];

    /**
     * Repositories
     *
     * @var array
     */
    protected $repositories = [];

    /**
     * AbstractResource constructor.
     *
     * @param AbstractHttpClient $http
     * @param array $data
     */
    public function __construct(AbstractHttpClient $http, array $data = [])
    {
        $this->http = $http;
        $this->data = $data;
    }

    /**
     * Magic get
     *
     * @param $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->data[$key];
    }

    /**
     * Magic set
     *
     * @param $key
     * @param $value
     */
    public function __set($key, $value)
    {
        $this->data[$key] = $value;
    }

    /**
     * Get repository
     *
     * @param $class
     *
     * @return AbstractRepository
     */
    public function getRepository($class)
    {
        return $this->repositories[$class];
    }

    /**
     * Get available repositories
     *
     * @return array;
     */
    public function getRepositories()
    {
        return $this->repositories;
    }

    /**
     * Set repository
     *
     * @param $key
     * @param $value
     *
     * @return array;
     */
    public function setRepository($key, $value)
    {
        return $this->repositories[$key] = $value;
    }
}