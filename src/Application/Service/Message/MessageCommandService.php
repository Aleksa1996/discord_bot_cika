<?php


namespace Discord\Application\Service\Message;


use Discord\Application\Event\CommandEvent;
use Discord\Application\Service\ApplicationService;
use Discord\Config\Config;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class MessageCommandService implements ApplicationService
{
    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @var Config
     */
    private $config;

    /**
     * MessageCommandService constructor.
     *
     * @param Config $config
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(Config $config, EventDispatcherInterface $eventDispatcher)
    {
        $this->config = $config;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @inheritDoc
     */
    public function execute($request = null)
    {
        if ($request === null) {
            return;
        }

        $command = $request->getCommand();

        if (!$command) {
            return;
        }

        $commandString = 'command.' . $command->getCommand();
        $commandEvent = new CommandEvent($request->getMessage(), $command);

        if ($this->eventDispatcher->hasListeners($commandString)) {
            $this->eventDispatcher->dispatch($commandEvent, $commandString);
            return;
        }

        $this->eventDispatcher->dispatch($commandEvent, 'command.notFound');
    }
}