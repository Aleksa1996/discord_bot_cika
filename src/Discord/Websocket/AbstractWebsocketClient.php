<?php


namespace Discord\Discord\Websocket;


use Discord\Discord\Exception\WebsocketClientException;
use Discord\Discord\Helper\Url;

abstract class AbstractWebsocketClient
{
    /**
     * Endpoint to connect on
     *
     * @var string
     */
    protected $endpoint;

    /**
     * Bot token
     *
     * @var string
     */
    protected $token;

    /**
     * List of events
     *
     * @var string[]
     */
    protected static $events = [
        'HELLO',
        'READY',
        'RESUMED',
        'RECONNECT',
        'INVALID_SESSION',
        'CHANNEL_CREATE',
        'CHANNEL_UPDATE',
        'CHANNEL_DELETE',
        'CHANNEL_PINS_UPDATE',
        'GUILD_CREATE',
        'GUILD_UPDATE',
        'GUILD_DELETE',
        'GUILD_BAN_ADD',
        'GUILD_BAN_REMOVE',
        'GUILD_EMOJIS_UPDATE',
        'GUILD_INTEGRATIONS_UPDATE1',
        'GUILD_MEMBER_ADD',
        'GUILD_MEMBER_REMOVE',
        'GUILD_MEMBER_UPDATE',
        'GUILD_MEMBERS_CHUNK',
        'GUILD_ROLE_CREATE',
        'GUILD_ROLE_UPDATE',
        'GUILD_ROLE_DELETE',
        'INVITE_CREATE',
        'INVITE_DELETE',
        'MESSAGE_CREATE',
        'MESSAGE_UPDATE',
        'MESSAGE_DELETE',
        'MESSAGE_DELETE_BULK',
        'MESSAGE_REACTION_ADD',
        'MESSAGE_REACTION_REMOVE',
        'MESSAGE_REACTION_REMOVE_ALL',
        'MESSAGE_REACTION_REMOVE_EMOJI',
        'PRESENCE_UPDATE',
        'TYPING_START',
        'USER_UPDATE',
        'VOICE_STATE_UPDATE',
        'VOICE_SERVER_UPDATE',
        'WEBHOOKS_UPDATE'
    ];

    /**
     * Listeners for events
     *
     * @var array
     */
    protected $listeners = [];

    /**
     * AbstractWebsocketClient constructor.
     *
     * @param string $endpoint
     * @param string $token
     */
    public function __construct(string $endpoint, string $token)
    {
        $this->endpoint = new Url($endpoint);
        $this->token = $token;
    }

    /**
     * Upgrade request to start Websocket communication
     *
     * @return bool
     */
    protected abstract function upgrade();

    /**
     * Heartbeating logic to maintain websocket connection
     *
     * @return mixed
     */
    protected abstract function heartbeat();

    /**
     * Identify
     *
     * @return bool
     */
    protected abstract function identify();

    /**
     * Blocking loop that is waiting for new messages
     *
     * @return mixed
     */
    protected abstract function loop();

    /**
     * Start Websocket client
     *
     * @throws WebsocketClientException
     */
    public function start()
    {
        if (!$this->upgrade()) {
            throw new WebsocketClientException('Could not upgrade to a websocket connection.');
        }

        $this->heartBeat();
        $this->identify();
        $this->loop();
    }

    /**
     * Dispatch event to listener
     *
     * @param $event
     * @param AbstractPayload $payload
     */
    protected function dispatchEvent($event, AbstractPayload $payload)
    {
        if (isset($this->listeners[$event])) {
            $this->listeners[$event]($payload);
        }
    }

    /**
     * Subscribe to bot event
     *
     * @param string $event
     * @param callable $callback
     *
     * @throws WebsocketClientException
     */
    public function on(string $event, callable $callback)
    {
        if (!in_array($event, static::$events, true)) {
            throw new WebsocketClientException(
                sprintf('Event: %s does not exists.', $event)
            );
        }

        $this->listeners[$event] = $callback;
    }
}