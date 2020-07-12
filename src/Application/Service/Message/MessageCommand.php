<?php


namespace Discord\Application\Service\Message;


class MessageCommand
{
    /**
     * @var string
     */
    private $command;

    /**
     * @var string[]
     */
    private $arguments;

    /**
     * @var string
     */
    private $commandSymbol;

    /**
     * MessageCommandRequest constructor.
     *
     * @param $commandSymbol
     * @param $command
     * @param array $arguments
     */
    public function __construct($commandSymbol, $command, $arguments = [])
    {
        $this->commandSymbol = $commandSymbol;
        $this->command = $command;
        $this->arguments = $arguments;
    }

    /**
     * @return string
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * @param string $command
     *
     * @return MessageCommand
     */
    public function setCommand($command)
    {
        $this->command = $command;
        return $this;
    }

    /**
     * @return array|string[]
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * @param string $arguments
     *
     * @return MessageCommand
     */
    public function setArguments($arguments)
    {
        $this->arguments = $arguments;
        return $this;
    }

    /**
     * @return string
     */
    public function getCommandSymbol()
    {
        return $this->commandSymbol;
    }

    /**
     * @param string $commandSymbol
     *
     * @return MessageCommand
     */
    public function setCommandSymbol($commandSymbol)
    {
        $this->commandSymbol = $commandSymbol;
        return $this;
    }
}