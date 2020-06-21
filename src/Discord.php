<?php

namespace Discord;

use Discord\Discord\Api\ApiClient;
use Discord\Discord\Websocket\Swoole\Payload;
use Discord\Discord\Websocket\Swoole\WebsocketClient;
use InvalidArgumentException;

class Discord
{

    /**
     * Api token
     *
     * @var string
     */
    private $token;

    /**
     * Endpoint for websocket
     *
     * @var string
     */
    private $websocketEndpoint = 'wss://gateway.discord.gg/?v=6&encoding=json';

    /**
     * endpoint for API
     *
     * @var string
     */
    private $apiEndpoint = 'https://discordapp.com/api/v6';

    /**
     * Websocket client
     *
     * @var WebsocketClient
     */
    private $websocketClient;

    /**
     * Registered events
     *
     * @var array
     */
    private $events;

    /**
     * @var WebsocketClient
     */
    private $apiClient;

    /**
     * @var
     */
    private $currentUser;

    /**
     * Discord constructor.
     *
     * @param $token
     */
    private function __construct($token)
    {
        $this->token = $token;
        $this->websocketClient = new WebsocketClient($this->websocketEndpoint, $token);
        $this->apiClient = new ApiClient($this->apiEndpoint, $token);
    }

    /**
     * Create instance of Discord class
     *
     * @param array $config
     *
     * @return static
     */
    public static function create(array $config)
    {
        foreach (static::getRequiredConfig() as $configItem) {
            if (empty($config[$configItem])) {
                throw new InvalidArgumentException(
                    sprintf('%s must be present in config.', $configItem)
                );
            }
        }

        return new static(
            $config['token']
        );
    }

    /**
     * Get required config
     *
     * @return string[]
     */
    private static function getRequiredConfig()
    {
        return [
            'token'
        ];
    }

    /**
     * Subscribe to bot event
     *
     * @param string $event
     * @param callable $callback
     * @return $this
     */
    public function on(string $event, callable $callback)
    {
        $this->events[$event][] = $callback;

        return $this;
    }

    /**
     * Start discord app
     *
     * @throws Discord\Exception\WebsocketClientException
     */
    public function start()
    {
        $this->registerWebsocketClientEvents();

        $this->websocketClient->start();
    }

    /**
     * Register events
     *
     * @throws Discord\Exception\WebsocketClientException
     */
    private function registerWebsocketClientEvents()
    {
        $this->events['READY'][] = [$this, 'onReady'];

        foreach ($this->events as $eventName => $eventCallbacks) {
            foreach ($eventCallbacks as $eventCallback) {
                $this->websocketClient->on($eventName, $eventCallback);
            }
        }
    }

    /**
     * API client
     *
     * @return ApiClient|WebsocketClient
     */
    public function api()
    {
        return $this->apiClient;
    }

    /**
     * Inner event listener
     *
     * @param Payload $payload
     */
    public function onReady(Payload $payload)
    {
        $this->currentUser = $payload->getEventData('user');
    }

    /**
     * @return mixed
     */
    public function getCurrentUser()
    {
        return $this->currentUser;
    }

}