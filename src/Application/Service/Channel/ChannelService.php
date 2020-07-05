<?php


namespace Discord\Application\Service\Channel;


use Discord\Application\Service\ApplicationService;
use Discord\Domain\Repository\ChannelRepositoryInterface;
use Discord\Domain\Repository\MessageRepositoryInterface;

abstract class ChannelService implements ApplicationService
{
    /**
     * @var ChannelRepositoryInterface
     */
    protected $channelRepository;

    /**
     * @var MessageRepositoryInterface
     */
    protected $messageRepository;

    /**
     * ChannelService constructor.
     *
     * @param ChannelRepositoryInterface $channelRepository
     * @param MessageRepositoryInterface $messageRepository
     */
    public function __construct(ChannelRepositoryInterface $channelRepository, MessageRepositoryInterface $messageRepository)
    {
        $this->channelRepository = $channelRepository;
        $this->messageRepository = $messageRepository;
    }
}