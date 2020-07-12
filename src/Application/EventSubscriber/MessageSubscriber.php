<?php


namespace Discord\Application\EventSubscriber;

use Discord\Application\Service\Message\MessageCommandRequest;
use Discord\Application\Service\Message\MessageCommandService;
use Discord\Config\Config;
use Discord\Infrastructure\Websocket\Event\MessageCreated;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class MessageSubscriber implements EventSubscriberInterface
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @var MessageCommandService
     */
    private $messageCommandService;

    /**
     * MessageSubscriber constructor.
     *
     * @param Config $config
     * @param MessageCommandService $messageCommandService
     */
    public function __construct(Config $config, MessageCommandService $messageCommandService)
    {
        $this->config = $config;
        $this->messageCommandService = $messageCommandService;
    }

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents()
    {
        return [
            MessageCreated::NAME => 'onMessageCreate'
        ];
    }

    /**
     * On message create
     *
     * @param MessageCreated $event
     */
    public function onMessageCreate(MessageCreated $event)
    {
        $request = new MessageCommandRequest(
            $this->config->getCommandSymbol(),
            $event->getMessage()
        );
        
        $this->messageCommandService->execute($request);
    }
}