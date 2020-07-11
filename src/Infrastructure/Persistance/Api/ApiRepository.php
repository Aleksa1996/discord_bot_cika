<?php


namespace Discord\Infrastructure\Persistance\Api;


use Discord\Application\Service\MapperService;
use Discord\Config\Config;
use Discord\Infrastructure\Http\HttpClientInterface;
use Discord\Infrastructure\Http\Swoole\HttpClient;

abstract class ApiRepository
{
    /**
     * @var Config
     */
    protected $config;

    /**
     * @var HttpClientInterface
     */
    protected $httpClient;

    /**
     * @var MapperService
     */
    protected $mapperService;

    /**
     * ChannelRepository constructor.
     *
     * @param Config $config
     * @param HttpClientInterface $httpClient
     * @param MapperService $mapperService
     */
    public function __construct(Config $config, HttpClientInterface $httpClient, MapperService $mapperService)
    {
        $this->config = $config;
        $this->httpClient = $httpClient;
        $this->mapperService = $mapperService;
    }
}