<?php


namespace Discord\Application\Service\Channel;


class SendMessageRequest
{
    /**
     * @var int
     */
    private $channelId;

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $file;

    /**
     * SendMessageRequest constructor.
     * @param int $channelId
     * @param string $content
     * @param string $file
     */
    public function __construct(int $channelId, string $content, string $file = null)
    {
        $this->channelId = $channelId;
        $this->content = $content;
        $this->file = $file;
    }

    /**
     * @return int
     */
    public function getChannelId(): int
    {
        return $this->channelId;
    }

    /**
     * @param int $channelId
     * @return SendMessageRequest
     */
    public function setChannelId($channelId)
    {
        $this->channelId = $channelId;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return SendMessageRequest
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param string $file
     * @return SendMessageRequest
     */
    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }
}