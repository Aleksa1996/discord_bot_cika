<?php


namespace Discord\Application\Service\Roast;


use Discord\Application\Service\ApplicationService;
use Discord\Application\Service\Channel\ChannelSendMessageService;
use Discord\Application\Service\Channel\SendMessageRequest;

class SendRoastService extends RoastService implements ApplicationService
{
    /**
     * @var ChannelSendMessageService
     */
    private $channelSendMessageService;

    /**
     * SendRoastService constructor.
     *
     * @param ChannelSendMessageService $channelSendMessageService
     */
    public function __construct(ChannelSendMessageService $channelSendMessageService)
    {
        $this->channelSendMessageService = $channelSendMessageService;
    }

    /**
     * @inheritDoc
     */
    public function execute($request = null)
    {
        $message = $request->getMessage();
        $roast = '';

        if (count($message->getMentions()) > 0) {
            $mentionedUser = $message->getMentions()[0];
            $roast = sprintf($this->getRoast('mention'), $mentionedUser['username']);
        } else {
            $roast = $this->getRoast('me');
        }
        
        $this->channelSendMessageService->execute(
            new SendMessageRequest(
                $message->getChannelId(),
                $roast
            )
        );

    }
}