<?php


namespace Discord\Domain\Model\Channel;


use Discord\Domain\Model\AbstractModel;
use Discord\Domain\Model\Message\MessageApi;
use Discord\Domain\Model\Timestamp;
use Discord\Domain\Model\User;

class Channel extends AbstractModel
{
    /**
     * The type of channel
     *
     * @var ChannelType
     */
    private $type;

    /**
     * The id of the guild
     *
     * @var int
     */
    private $guild_id;

    /**
     * Sorting position of the channel
     *
     * @var int
     */
    private $position;

    /**
     * Explicit permission overwrites for members and roles
     *
     * @var array
     */
    private $permission_overwrites;

    /**
     * The name of the channel (2-100 characters)
     *
     * @var string
     */
    private $name;

    /**
     * The channel topic (0-1024 characters)
     *
     * @var string
     */
    private $topic;

    /**
     * Whether the channel is nsfw
     *
     * @var bool
     */
    private $nsfw;

    /**
     * The id of the last message sent in this channel (may not point to an existing or valid message)
     *
     * @var int
     */
    private $last_message_id;

    /**
     * The bitrate (in bits) of the voice channel
     *
     * @var int
     */
    private $bitrate;

    /**
     * The user limit of the voice channel
     *
     * @var int
     */
    private $user_limit;

    /**
     * Amount of seconds a user has to wait before sending another message (0-21600);
     * bots, as well as users with the permission manage_messages or manage_channel, are unaffected
     *
     * @var int
     */
    private $rate_limit_per_user;

    /**
     * The recipients of the DM
     *
     * @var User[]
     */
    private $recipients;

    /**
     * Icon hash
     *
     * @var string
     */
    private $icon;

    /**
     * Id of the DM creator
     *
     * @var int
     */
    private $owner_id;

    /**
     * Application id of the group DM creator if it is bot-created
     *
     * @var int
     */
    private $application_id;

    /**
     * Id of the parent category for a channel (each parent category can contain up to 50 channels)
     *
     * @var int
     */
    private $parent_id;

    /**
     * When the last pinned message was pinned
     *
     * @var Timestamp
     */
    private $last_pin_timestamp;


    /**
     * @return ChannelType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $type
     * @return Channel
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return int
     */
    public function getGuildId()
    {
        return $this->guild_id;
    }

    /**
     * @param int $guild_id
     * @return Channel
     */
    public function setGuildId($guild_id)
    {
        $this->guild_id = $guild_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int $position
     * @return Channel
     */
    public function setPosition($position)
    {
        $this->position = $position;
        return $this;
    }

    /**
     * @return array
     */
    public function getPermissionOverwrites()
    {
        return $this->permission_overwrites;
    }

    /**
     * @param array $permission_overwrites
     * @return Channel
     */
    public function setPermissionOverwrites(array $permission_overwrites)
    {
        $this->permission_overwrites = $permission_overwrites;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Channel
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * @param string $topic
     * @return Channel
     */
    public function setTopic($topic)
    {
        $this->topic = $topic;
        return $this;
    }

    /**
     * @return bool
     */
    public function isNsfw()
    {
        return $this->nsfw;
    }

    /**
     * @param bool $nsfw
     * @return Channel
     */
    public function setNsfw(bool $nsfw)
    {
        $this->nsfw = $nsfw;
        return $this;
    }

    /**
     * @return int
     */
    public function getLastMessageId()
    {
        return $this->last_message_id;
    }

    /**
     * @param int $last_message_id
     * @return Channel
     */
    public function setLastMessageId($last_message_id)
    {
        $this->last_message_id = $last_message_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getBitrate()
    {
        return $this->bitrate;
    }

    /**
     * @param int $bitrate
     * @return Channel
     */
    public function setBitrate($bitrate)
    {
        $this->bitrate = $bitrate;
        return $this;
    }

    /**
     * @return int
     */
    public function getUserLimit()
    {
        return $this->user_limit;
    }

    /**
     * @param int $user_limit
     * @return Channel
     */
    public function setUserLimit($user_limit)
    {
        $this->user_limit = $user_limit;
        return $this;
    }

    /**
     * @return int
     */
    public function getRateLimitPerUser()
    {
        return $this->rate_limit_per_user;
    }

    /**
     * @param int $rate_limit_per_user
     * @return Channel
     */
    public function setRateLimitPerUser($rate_limit_per_user)
    {
        $this->rate_limit_per_user = $rate_limit_per_user;
        return $this;
    }

    /**
     * @return User[]
     */
    public function getRecipients()
    {
        return $this->recipients;
    }

    /**
     * @param User[] $recipients
     * @return Channel
     */
    public function setRecipients(array $recipients)
    {
        $this->recipients = $recipients;
        return $this;
    }

    /**
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param string $icon
     * @return Channel
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
        return $this;
    }

    /**
     * @return int
     */
    public function getOwnerId()
    {
        return $this->owner_id;
    }

    /**
     * @param int $owner_id
     * @return Channel
     */
    public function setOwnerId($owner_id)
    {
        $this->owner_id = $owner_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getApplicationId()
    {
        return $this->application_id;
    }

    /**
     * @param int $application_id
     * @return Channel
     */
    public function setApplicationId($application_id)
    {
        $this->application_id = $application_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getParentId()
    {
        return $this->parent_id;
    }

    /**
     * @param int $parent_id
     * @return Channel
     */
    public function setParentId($parent_id)
    {
        $this->parent_id = $parent_id;
        return $this;
    }

    /**
     * @return Timestamp
     */
    public function getLastPinTimestamp()
    {
        return $this->last_pin_timestamp;
    }

    /**
     * @param int $last_pin_timestamp
     * @return Channel
     */
    public function setLastPinTimestamp($last_pin_timestamp)
    {
        $this->last_pin_timestamp = $last_pin_timestamp;
        return $this;
    }

    /**
     * Create message
     *
     * @param $content
     * @param null $file
     *
     * @return MessageApi
     */
    public function createMessage($content, $file = null)
    {
        return new MessageApi($this->id, $content, $file);
    }
}