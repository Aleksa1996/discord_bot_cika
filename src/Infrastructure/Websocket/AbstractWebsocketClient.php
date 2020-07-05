<?php


namespace Discord\Infrastructure\Websocket;

use Discord\Application\Service\MapperService;
use Discord\Config\Config;
use Discord\Infrastructure\Websocket\Event\MessageCreated;
use Discord\Infrastructure\Websocket\Exception\WebsocketClientException;
use ReflectionException;
use ReflectionParameter;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

abstract class AbstractWebsocketClient
{
    /**
     * List of events
     *
     * @var string[]
     */
    public const EVENTS = [
        'HELLO' => '',
        'READY' => '',
        'RESUMED' => '',
        'RECONNECT' => '',
        'INVALID_SESSION' => '',
        'CHANNEL_CREATE' => '',
        'CHANNEL_UPDATE' => '',
        'CHANNEL_DELETE' => '',
        'CHANNEL_PINS_UPDATE' => '',
        'GUILD_CREATE' => '',
        'GUILD_UPDATE' => '',
        'GUILD_DELETE' => '',
        'GUILD_BAN_ADD' => '',
        'GUILD_BAN_REMOVE' => '',
        'GUILD_EMOJIS_UPDATE' => '',
        'GUILD_INTEGRATIONS_UPDATE' => '',
        'GUILD_MEMBER_ADD' => '',
        'GUILD_MEMBER_REMOVE' => '',
        'GUILD_MEMBER_UPDATE' => '',
        'GUILD_MEMBERS_CHUNK' => '',
        'GUILD_ROLE_CREATE' => '',
        'GUILD_ROLE_UPDATE' => '',
        'GUILD_ROLE_DELETE' => '',
        'INVITE_CREATE' => '',
        'INVITE_DELETE' => '',
        'MESSAGE_CREATE' => MessageCreated::class,
        'MESSAGE_UPDATE' => '',
        'MESSAGE_DELETE' => '',
        'MESSAGE_DELETE_BULK' => '',
        'MESSAGE_REACTION_ADD' => '',
        'MESSAGE_REACTION_REMOVE' => '',
        'MESSAGE_REACTION_REMOVE_ALL' => '',
        'MESSAGE_REACTION_REMOVE_EMOJI' => '',
        'PRESENCE_UPDATE' => '',
        'TYPING_START' => '',
        'USER_UPDATE' => '',
        'VOICE_STATE_UPDATE' => '',
        'VOICE_SERVER_UPDATE' => '',
        'WEBHOOKS_UPDATE' => ''
    ];

    /**
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    /**
     * @var MapperService
     */
    protected $mapper;

    /**
     * @var Config
     */
    protected $config;

    /**
     * AbstractWebsocketClient constructor.
     *
     * @param Config $config
     * @param EventDispatcherInterface $eventDispatcher
     * @param MapperService $mapperService
     */
    public function __construct(Config $config, EventDispatcherInterface $eventDispatcher, MapperService $mapperService)
    {
        $this->config = $config;
        $this->eventDispatcher = $eventDispatcher;
        $this->mapper = $mapperService;
    }


    /**
     * Connect to websocket server
     *
     * @throws WebsocketClientException
     */
    public function start()
    {
        $this->connect();
        $this->heartBeat();
        $this->identify();
        $this->listen();
    }

    /**
     * Connect to gateway
     *
     * @return mixed
     */
    protected abstract function connect();

    /**
     * Heartbeating logic
     *
     * @throws WebsocketClientException
     */
    protected abstract function heartBeat();

    /**
     * Identify
     */
    protected abstract function identify();

    /**
     * Push to websocket server
     *
     * @param Payload $payload
     */
    public abstract function push(Payload $payload);

    /**
     * Read from websocket server
     *
     * @return Payload|bool
     *
     * @throws WebsocketClientException
     */
    public abstract function read();

    /**
     * Listen for events
     *
     * @throws WebsocketClientException
     */
    protected function listen()
    {
        while ($payload = $this->read()) {
            if ($payload->getEventName() !== null) {
                $this->dispatchEvent($payload->getEventName(), $payload);
            }
        }
    }

    /**
     * Get event by name
     *
     * @param $eventName
     *
     * @return string|null
     */
    protected function getEvent($eventName)
    {
        return static::EVENTS[$eventName] ?? null;
    }

    /**
     * Dispatch event
     *
     * @param $eventName
     * @param $payload
     */
    protected function dispatchEvent($eventName, Payload $payload)
    {
        if ($eventToDispatch = $this->getEvent($eventName)) {
            $event = new $eventToDispatch($this->mapPayloadForEvent($eventToDispatch, $payload));
            $this->eventDispatcher->dispatch($event, $event::NAME);
        }
    }

    /**
     * @param $event
     * @param Payload $payload
     *
     * @return mixed
     */
    protected function mapPayloadForEvent($event, Payload $payload)
    {
        try {
            $param = new ReflectionParameter([$event, '__construct'], 0);
        } catch (ReflectionException $e) {
            return $payload->getEventData();
        }

        if ($param->getClass() === null) {
            return $payload->getEventData();
        }

        return $this->mapper->map($payload->getEventData(), $param->getClass()->name);
    }
}