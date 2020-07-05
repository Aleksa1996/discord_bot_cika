<?php


namespace Discord\Infrastructure\Persistance\Api;


use Discord\Application\Service\MapperService;
use Discord\Config\Config;
use Discord\Domain\Model\Channel\Channel;
use Discord\Domain\Model\Message\Message;
use Discord\Domain\Model\Message\MessageApi;
use Discord\Domain\Repository\MessageRepositoryInterface;
use Discord\Helper\Url;
use Discord\Infrastructure\Http\Exception\HttpClientException;
use Discord\Infrastructure\Http\Swoole\HttpClient;

class MessageRepository implements MessageRepositoryInterface
{
    /**
     * @var array
     */
    private static $endpoints = [
        'create' => '/channels/:channel_id/messages'
    ];

    /**
     * @var Config
     */
    private $config;

    /**
     * @var HttpClient
     */
    private $httpClient;

    /**
     * @var MapperService
     */
    private $mapperService;

    /**
     * MessageRepository constructor.
     *
     * @param Config $config
     * @param HttpClient $httpClient
     * @param MapperService $mapperService
     */
    public function __construct(Config $config, HttpClient $httpClient, MapperService $mapperService)
    {
        $this->config = $config;
        $this->httpClient = $httpClient;
        $this->mapperService = $mapperService;
    }

    /**
     * @inheritDoc
     */
    public function add(MessageApi $messageApi)
    {
        try {
            $url = new Url($this->config->getApiEndpoint() . static::$endpoints['create']);
            $replacedParamsUrl = $url->replaceParams(['channel_id' => $messageApi->getChannelId()]);
            $options = [
                'headers' => [
                    'Authorization' => 'Bot ' . $this->config->getToken(),
                    'Content-Type' => 'application/json'
                ],
                'body' => json_encode($messageApi)
            ];

            $response = $this->httpClient->request(
                'POST',
                $replacedParamsUrl,
                $options
            );

            if ($response->getStatusCode() != 200) {
                return null;
            }

            $data = json_decode($response->getContent(), true);
            return $this->mapperService->map($data, Message::class);
        } catch (HttpClientException $e) {
            return null;
        }
    }
}