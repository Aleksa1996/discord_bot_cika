<?php

namespace Discord\Discord\Api;

use Discord\Discord\Api\Http\Swoole\HttpClient;
use Discord\Discord\Api\Resource\AbstractResource;
use Discord\Discord\Api\Resource\ChannelResource;

class ApiClient
{
    /**
     * Http client
     *
     * @var HttpClient
     */
    private $http;

    /**
     * List of resources
     *
     * @var AbstractResource[]
     */
    private $resources = [
        ChannelResource::class
    ];

    /**
     * @var string
     */
    private $endpoint;

    /**
     * @var string
     */
    private $token;

    /**
     * ApiClient constructor.
     *
     * @param string $endpoint
     * @param string $token
     */
    public function __construct(string $endpoint, string $token)
    {
        $this->http = new HttpClient();
        $this->endpoint = $endpoint;
        $this->token = $token;
        $this->createResources();
    }

    /**
     * Create resources
     *
     */
    private function createResources()
    {
        foreach ($this->resources as $resourceClass) {

            /**
             * @var AbstractResource
             */
            $resource = new $resourceClass($this->http);

            foreach ($resource->getRepositories() as $repository) {
                $resource->setRepository(
                    $repository,
                    new $repository($this->endpoint, $this->token, $this->http)
                );
            }

            $this->resources[$resourceClass] = $resource;
        }
    }

    /**
     * Get channels resource
     *
     * @return ChannelResource
     */
    public function channels()
    {
        return $this->resources[ChannelResource::class];
    }


}