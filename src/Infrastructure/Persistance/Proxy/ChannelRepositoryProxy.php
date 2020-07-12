<?php


namespace Discord\Infrastructure\Persistance\Proxy;


use Discord\Domain\Repository\ChannelRepositoryInterface;
use Discord\Infrastructure\Persistance\Api\ChannelRepository;

class ChannelRepositoryProxy extends InMemoryRepositoryProxy implements ChannelRepositoryInterface
{
    /**
     * @var ChannelRepositoryInterface
     */
    private $channelRepository;

    public function __construct(ChannelRepository $channelRepository)
    {
        $this->channelRepository = $channelRepository;
    }

    /**
     * @inheritDoc
     */
    public function findById($id)
    {
        $cached = $this->getFromStorage($id);

        if (!is_null($cached)) {
            return $cached;
        }

        $channel = $this->channelRepository->findById($id);
        $this->putInStorage($id, $channel);

        return $channel;
    }
}