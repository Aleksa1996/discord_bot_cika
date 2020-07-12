<?php


namespace Discord\Application\Event;


use Discord\Application\Service\Message\MessageCommand;
use Discord\Domain\Model\Message\Message;
use Symfony\Contracts\EventDispatcher\Event;

class CommandEvent extends Event
{
    /**
     * @var Message
     */
    private $message;

    /**
     * @var MessageCommand
     */
    private $command;

    /**
     * CommandEvent constructor.
     *
     * @param Message $message
     * @param MessageCommand $command
     */
    public function __construct(Message $message, MessageCommand $command)
    {
        $this->message = $message;
        $this->command = $command;
    }

    /**
     * @return MessageCommand
     */
    public function getCommand(): string
    {
        return $this->command;
    }

    /**
     * @param MessageCommand $command
     *
     * @return CommandEvent
     */
    public function setCommand($command)
    {
        $this->command = $command;
        return $this;
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
     * @return CommandEvent
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

}