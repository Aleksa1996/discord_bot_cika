<?php

namespace Discord;

use Discord\Config\Config;
use Discord\Infrastructure\Environment\RuntimeEnvironmentInterface;
use Discord\Infrastructure\Http\HttpClientInterface;
use Discord\Infrastructure\Websocket\AbstractWebsocketClient;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class Discord
{
    /**
     * @var HttpClientInterface
     */
    private $httpClient;

    /**
     * Websocket client
     *
     * @var AbstractWebsocketClient
     */
    private $websocketClient;

    /**
     * Registered events
     *
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @var RuntimeEnvironmentInterface|null
     */
    private $runtimeContext;

    /**
     * Discord constructor.
     *
     * @param Config $config
     * @param HttpClientInterface $httpClient
     * @param AbstractWebsocketClient $websocketClient
     * @param EventDispatcherInterface $eventDispatcher
     * @param RuntimeEnvironmentInterface $runtimeContext
     */
    public function __construct(
        Config $config,
        HttpClientInterface $httpClient,
        AbstractWebsocketClient $websocketClient,
        EventDispatcherInterface $eventDispatcher,
        RuntimeEnvironmentInterface $runtimeContext = null
    )
    {
        $this->httpClient = $httpClient;
        $this->websocketClient = $websocketClient;
        $this->eventDispatcher = $eventDispatcher;
        $this->runtimeContext = $runtimeContext;
    }

    /**
     * Set event listener
     *
     * @param $action
     * @param $listener
     */
    public function on($action, $listener)
    {
        $this->eventDispatcher->addListener($action, $listener);
    }

    /**
     * Set event listener
     *
     * @param $subscriber
     */
    public function subscribe($subscriber)
    {
        $this->eventDispatcher->addSubscriber($subscriber);
    }

    /**
     *  Start discord bot
     *
     * @throws Infrastructure\Websocket\Exception\WebsocketClientException
     */
    public function start()
    {
        if ($this->runtimeContext) {
            $this->runtimeContext->run(function () {
                $this->websocketClient->start();
            });
        } else {
            $this->websocketClient->start();
        }

    }
}