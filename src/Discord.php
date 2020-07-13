<?php

namespace Discord;

use Discord\Config\Config;
use Discord\Config\EventListenerPass;
use Discord\Infrastructure\Environment\RuntimeEnvironmentInterface;
use Discord\Infrastructure\Websocket\Swoole\WebsocketClient;
use Exception;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class Discord
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @var RuntimeEnvironmentInterface|null
     */
    private $runtimeContext;

    /**
     * @var ContainerBuilder
     */
    private $serviceContainer;

    /**
     * Discord constructor.
     *
     * @param Config $config
     * @param RuntimeEnvironmentInterface $runtimeContext
     *
     * @throws Exception
     */
    public function __construct(
        Config $config,
        RuntimeEnvironmentInterface $runtimeContext = null
    )
    {
        $this->config = $config;
        $this->runtimeContext = $runtimeContext;
        $this->boot();
    }

    /**
     * Boot discord app
     *
     * @throws Exception
     */
    private function boot()
    {
        // build container and load configuration
        $this->serviceContainer = new ContainerBuilder();
        $loader = new YamlFileLoader($this->serviceContainer, new FileLocator(__DIR__ . '/Config'));
        $loader->load('services.yaml');

        // setup synthetic services
        $this->serviceContainer->set('discord', $this);
        $this->serviceContainer->set('discord_config', $this->config);

        // add compiler pass
        $this->serviceContainer->addCompilerPass(new EventListenerPass());

        // compiler container
        $this->serviceContainer->compile();
    }

    /**
     * @return ContainerBuilder
     */
    public function getServiceContainer()
    {
        return $this->serviceContainer;
    }

    /**
     * @param ContainerBuilder $serviceContainer
     *
     * @return Discord
     */
    public function setServiceContainer(ContainerBuilder $serviceContainer)
    {
        $this->serviceContainer = $serviceContainer;
        return $this;
    }

    /**
     * @return Object|null
     *
     * @throws Exception
     */
    public function getEventDispatcher()
    {
        return $this->serviceContainer->get('event_dispatcher');
    }

    /**
     * @return Object|null
     *
     * @throws Exception
     */
    public function getHttpClient()
    {
        return $this->serviceContainer->get('http_client');
    }

    /**
     * @return Object|null
     *
     * @throws Exception
     */
    public function getWebsocketClient()
    {
        return $this->serviceContainer->get('websocket_client');
    }

    /**
     * Set event listener
     *
     * @param $action
     * @param $listener
     *
     * @throws Exception
     */
    public function on($action, $listener)
    {
        $this->getEventDispatcher()->addListener($action, $listener);
    }

    /**
     * Set event listener
     *
     * @param $subscriber
     *
     * @throws Exception
     */
    public function subscribe($subscriber)
    {
        $this->getEventDispatcher()->addSubscriber($subscriber);
    }

    /**
     *  Start discord bot
     *
     *
     * @throws Exception
     */
    public function start()
    {
        if ($this->runtimeContext) {
            $this->runtimeContext->run(function () {
                $this->getWebsocketClient()->start();
            });
        } else {
            $this->getWebsocketClient()->start();
        }

    }
}