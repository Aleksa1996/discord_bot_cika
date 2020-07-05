<?php


namespace Discord\Application\EventSubscriber;


use Discord\Application\Service\Channel\ChannelSendMessageService;
use Discord\Application\Service\Channel\SendMessageRequest;
use Discord\Infrastructure\Websocket\Event\MessageCreated;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class MessageSubscriber implements EventSubscriberInterface
{
    /**
     * @var ChannelSendMessageService
     */
    private $channelSendMessageService;

    /**
     * MessageSubscriber constructor.
     *
     * @param ChannelSendMessageService $channelSendMessageService
     */
    public function __construct(ChannelSendMessageService $channelSendMessageService)
    {
        $this->channelSendMessageService = $channelSendMessageService;
        $this->did = false;
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

    public function onMessageCreate(MessageCreated $event)
    {
        if ($this->did) {
            return;
        }

        $message = $event->getMessage();

        $request = new SendMessageRequest(
            $message->getChannelId(),
            'Sikilie'
        );

        $message = $this->channelSendMessageService->execute($request);
        $this->did = true;


        var_dump($event->getMessage()->getId());
        var_dump($event->getMessage()->getContent());
        var_dump($event->getMessage()->getChannelId());
        var_dump($message);
    }
}