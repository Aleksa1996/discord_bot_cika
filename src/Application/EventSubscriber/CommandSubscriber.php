<?php


namespace Discord\Application\EventSubscriber;


use Discord\Application\Event\CommandEvent;
use Discord\Application\Service\Channel\ChannelSendMessageService;
use Discord\Application\Service\Roast\RoastRequest;
use Discord\Application\Service\Roast\SendRoastService;
use Discord\Domain\Repository\UserRepositoryInterface;
use Exception;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CommandSubscriber implements EventSubscriberInterface
{
    /**
     * @var ChannelSendMessageService
     */
    private $channelSendMessageService;

    /**
     * @var SendRoastService
     */
    private $sendRoastService;

    /**
     * CommandSubscriber constructor.
     *
     * @param ChannelSendMessageService $channelSendMessageService
     * @param SendRoastService $sendRoastService
     */
    public function __construct(ChannelSendMessageService $channelSendMessageService, SendRoastService $sendRoastService)
    {
        $this->channelSendMessageService = $channelSendMessageService;
        $this->sendRoastService = $sendRoastService;
    }

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents()
    {
        return [
            'command.roastuj' => 'onRoastCommand'
        ];
    }

    /**
     * On roast command
     *
     * @param CommandEvent $event
     *
     * @throws Exception
     */
    public function onRoastCommand(CommandEvent $event)
    {
        $message = $event->getMessage();
        $this->sendRoastService->execute(new RoastRequest($message));
    }

}