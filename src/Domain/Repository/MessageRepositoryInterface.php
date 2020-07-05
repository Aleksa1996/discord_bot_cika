<?php


namespace Discord\Domain\Repository;


use Discord\Domain\Model\Message\Message;
use Discord\Domain\Model\Message\MessageApi;

interface MessageRepositoryInterface
{
    /**
     * @param MessageApi $messageApi
     *
     * @return Message|null
     */
    public function add(MessageApi $messageApi);
}