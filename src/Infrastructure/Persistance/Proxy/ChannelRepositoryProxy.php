<?php


namespace Discord\Infrastructure\Persistance\Proxy;


use Discord\Domain\Repository\ChannelRepositoryInterface;
use Discord\Infrastructure\Persistance\Api\ChannelRepository;

class ChannelRepositoryProxy implements ChannelRepositoryInterface
{
    /**
     * @var array
     */
    private $storage = [];

    /**
     * @var ChannelRepositoryInterface
     */
    private $channelRepository;

    public function __construct(ChannelRepository $channelRepository)
    {
        $this->channelRepository = $channelRepository;
    }

    /**
     * Put key-value pair to in memory storage
     *
     * @param $key
     * @param $value
     *
     * @return ChannelRepositoryProxy
     */
    public function putInStorage($key, $value)
    {
        $this->storage[$key] = $value;

        return $this;
    }

    /**
     * Get from in memory storage
     *
     * @param $key
     *
     * @return mixed
     */
    public function getFromStorage($key)
    {
        return $this->storage[$key] ?? null;
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