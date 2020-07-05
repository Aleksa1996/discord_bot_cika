<?php


namespace Discord\Infrastructure\Websocket\Event;


use Discord\Domain\Model\Message\Message;
use Symfony\Contracts\EventDispatcher\Event;

class MessageCreated extends Event
{
    /**
     * Message created event name
     */
    public const NAME = 'message.created';

    /**
     * @var Message
     */
    protected $message;

    /**
     * MessageCreated constructor.
     *
     * @param Message $message
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * Get message
     *
     * @return Message
     */
    public function getMessage()
    {
        return $this->message;
    }
}