<?php


namespace Discord\Application\Service\Channel;


use Exception;

class ChannelSendMessageService extends ChannelService
{
    /**
     * @inheritDoc
     *
     * @throws Exception
     */
    public function execute($request = null)
    {
        $channel = $this->channelRepository->findById($request->getChannelId());

        if ($channel === null) {
            throw new Exception('Channel not found.');
        }

        $messageApi = $channel->createMessage(
            $request->getContent(),
            $request->getFile()
        );

        return $this->messageRepository->add($messageApi);
    }
}