<?php


namespace Discord\Domain\Repository;


use Discord\Domain\Model\Channel\Channel;

interface ChannelRepositoryInterface
{
    /**
     * @param $id
     *
     * @return Channel|null
     */
    public function findById($id);
}