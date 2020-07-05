<?php


namespace Discord\Domain\Model\Message;


class MessageApi implements \JsonSerializable
{
    /**
     * The message contents (up to 2000 characters)
     *
     * @var string
     */
    private $content;

    /**
     * @var int
     */
    private $channelId;

    /**
     * A nonce that can be used for optimistic message sending
     *
     * @var int
     */
    private $nonce;

    /**
     * True if this is a TTS message
     *
     * @var bool
     */
    private $tts;

    /**
     * The contents of the file being sent
     *
     * @var string
     */
    private $file;

    /**
     * Embedded rich content
     *
     * @var mixed
     */
    private $embed;

    /**
     * JSON encoded body of any additional request fields.
     *
     * @var string
     */
    private $payload_json;

    /**
     * Allowed mentions for a message
     *
     * @var string
     */
    private $allowed_mentions;

    /**
     * MessageApi constructor.
     *
     * @param int $channelId
     * @param string $content
     * @param string $file
     */
    public function __construct($channelId, string $content, string $file = null)
    {
        $this->channelId = $channelId;
        $this->content = $content;
        $this->file = $file;
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
     * @return MessageApi
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return int
     */
    public function getNonce()
    {
        return $this->nonce;
    }

    /**
     * @param int $nonce
     * @return MessageApi
     */
    public function setNonce(int $nonce)
    {
        $this->nonce = $nonce;
        return $this;
    }

    /**
     * @return bool
     */
    public function isTts()
    {
        return $this->tts;
    }

    /**
     * @param bool $tts
     * @return MessageApi
     */
    public function setTts($tts)
    {
        $this->tts = $tts;
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
     * @return MessageApi
     */
    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmbed()
    {
        return $this->embed;
    }

    /**
     * @param mixed $embed
     * @return MessageApi
     */
    public function setEmbed($embed)
    {
        $this->embed = $embed;
        return $this;
    }

    /**
     * @return string
     */
    public function getPayloadJson()
    {
        return $this->payload_json;
    }

    /**
     * @param string $payload_json
     * @return MessageApi
     */
    public function setPayloadJson($payload_json)
    {
        $this->payload_json = $payload_json;
        return $this;
    }

    /**
     * @return string
     */
    public function getAllowedMentions()
    {
        return $this->allowed_mentions;
    }

    /**
     * @param string $allowed_mentions
     * @return MessageApi
     */
    public function setAllowedMentions($allowed_mentions)
    {
        $this->allowed_mentions = $allowed_mentions;
        return $this;
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
     * @return MessageApi
     */
    public function setChannelId(int $channelId): MessageApi
    {
        $this->channelId = $channelId;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'content' => $this->content,
            'nonce' => $this->nonce,
            'tts' => $this->tts,
            'file' => $this->file,
            'embed' => $this->embed,
            'payload_json' => $this->payload_json,
            'allowed_mentions' => $this->allowed_mentions,
        ];
    }
}