<?php


namespace Discord\Discord\Api\Resource;


use Discord\Discord\Api\Entity\MessageEntity;
use Discord\Discord\Api\Http\Request;
use Discord\Discord\Api\Repository\MessageRepository;
use Discord\Discord\Exception\HttpClientException;

class ChannelResource extends AbstractResource
{
    /**
     * List of repositories
     *
     * @var array
     */
    protected $repositories = [
        MessageRepository::class
    ];

    /**
     * @param MessageEntity $message
     *
     * @return Request
     *
     * @throws HttpClientException
     */
    public function createMessage(MessageEntity $message)
    {
        /**
         * @var MessageRepository
         */
        $messageRepository = $this->getRepository(MessageRepository::class);
        $url = $messageRepository->getEndpoint('create', ['channel_id' => 722909224883191892]);
        $request = $messageRepository->buildRequest('POST', $url, json_encode($message));

        return $this->http->request($request);
    }

}