<?php


namespace Discord\Application\Service\Roast;


use Discord\Domain\Model\Message\Message;

class RoastRequest
{
    /**
     * @var Message
     */
    private $message;

    /**
     * RoastRequest constructor.
     *
     * @param Message $message
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * @return Message
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param Message $message
     *
     * @return RoastRequest
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

}