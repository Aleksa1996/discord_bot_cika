<?php

namespace Discord\Discord\Api\Entity;

class MessageEntity extends AbstractEntity
{
    /**
     * The message contents (up to 2000 characters)
     *
     * @var string
     */
    private $content;

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
     * @var Embed
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
     * @var string[]
     */
    protected $serializableFields = [
        'content',
        'nonce',
        'tts',
        'file',
        'embed',
        'payload_json',
        'allowed_mentions'
    ];

    /**
     * MessageEntity constructor.
     *
     * @param $content
     * @param $nonce
     * @param $tts
     * @param $file
     * @param $embed
     * @param $payload_json
     * @param $allowed_mentions
     *
     */
    public function __construct($content, $nonce = null, $tts = false, $file = null, $embed = null, $payload_json = '', $allowed_mentions = [])
    {
        $this->content = $content;
        $this->nonce = $nonce;
        $this->tts = $tts;
        $this->file = $file;
        $this->embed = $embed;
        $this->payload_json = $payload_json;
        $this->allowed_mentions = $allowed_mentions;
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
     * @return MessageEntity
     */
    public function setContent(string $content)
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
     * @return MessageEntity
     */
    public function setNonce(int $nonce)
    {
        $this->nonce = $nonce;
        return $this;
    }

    /**
     * @return bool
     */
    public function getTts()
    {
        return $this->tts;
    }

    /**
     * @param bool $tts
     * @return MessageEntity
     */
    public function setTts(bool $tts)
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
     * @return MessageEntity
     */
    public function setFile(string $file)
    {
        $this->file = $file;
        return $this;
    }

    /**
     * @return Embed
     */
    public function getEmbed()
    {
        return $this->embed;
    }

    /**
     * @param Embed $embed
     * @return MessageEntity
     */
    public function setEmbed(Embed $embed)
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
     * @return MessageEntity
     */
    public function setPayloadJson(string $payload_json)
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
     * @return MessageEntity
     */
    public function setAllowedMentions(string $allowed_mentions)
    {
        $this->allowed_mentions = $allowed_mentions;
        return $this;
    }

}