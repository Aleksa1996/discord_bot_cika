<?php

namespace Discord\Application\Service\Message;

use Discord\Domain\Model\Message\Message;

class MessageCommandRequest
{
    /**
     * @var Message
     */
    private $message;

    /**
     * @var MessageCommand|null
     */
    private $command;

    /**
     * MessageCommandRequest constructor.
     *
     * @param $commandSymbol
     * @param Message $message
     */
    public function __construct($commandSymbol, Message $message)
    {
        $this->message = $message;
        $this->command = MessageCommandFactory::fromMessage($commandSymbol, $message);
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
     * @return MessageCommandRequest
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }


    /**
     * @return MessageCommand
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * @param MessageCommand $command
     *
     * @return MessageCommandRequest
     */
    public function setCommand($command)
    {
        $this->command = $command;
        return $this;
    }
}