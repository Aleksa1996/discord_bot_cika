<?php

namespace Discord\Discord\Api\Entity;


class Channel extends AbstractEntity
{
    /**
     * The id of this channel
     *
     * @var int
     */
    private $id;

    /**
     * The type of channel
     *
     * @var int
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
     * @var Overwrite[]
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
     * @var int
     */
    private $last_pin_timestamp;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getGuildId()
    {
        return $this->guild_id;
    }

    /**
     * @param mixed $guild_id
     */
    public function setGuildId($guild_id)
    {
        $this->guild_id = $guild_id;
    }

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param mixed $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @return mixed
     */
    public function getPermissionOverwrites()
    {
        return $this->permission_overwrites;
    }

    /**
     * @param mixed $permission_overwrites
     */
    public function setPermissionOverwrites($permission_overwrites)
    {
        $this->permission_overwrites = $permission_overwrites;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * @param mixed $topic
     */
    public function setTopic($topic)
    {
        $this->topic = $topic;
    }

    /**
     * @return mixed
     */
    public function getNsfw()
    {
        return $this->nsfw;
    }

    /**
     * @param mixed $nsfw
     */
    public function setNsfw($nsfw)
    {
        $this->nsfw = $nsfw;
    }

    /**
     * @return mixed
     */
    public function getLastMessageId()
    {
        return $this->last_message_id;
    }

    /**
     * @param mixed $last_message_id
     */
    public function setLastMessageId($last_message_id)
    {
        $this->last_message_id = $last_message_id;
    }

    /**
     * @return mixed
     */
    public function getBitrate()
    {
        return $this->bitrate;
    }

    /**
     * @param mixed $bitrate
     */
    public function setBitrate($bitrate)
    {
        $this->bitrate = $bitrate;
    }

    /**
     * @return mixed
     */
    public function getUserLimit()
    {
        return $this->user_limit;
    }

    /**
     * @param mixed $user_limit
     */
    public function setUserLimit($user_limit)
    {
        $this->user_limit = $user_limit;
    }

    /**
     * @return mixed
     */
    public function getRateLimitPerUser()
    {
        return $this->rate_limit_per_user;
    }

    /**
     * @param mixed $rate_limit_per_user
     */
    public function setRateLimitPerUser($rate_limit_per_user)
    {
        $this->rate_limit_per_user = $rate_limit_per_user;
    }

    /**
     * @return mixed
     */
    public function getRecipients()
    {
        return $this->recipients;
    }

    /**
     * @param mixed $recipients
     */
    public function setRecipients($recipients)
    {
        $this->recipients = $recipients;
    }

    /**
     * @return mixed
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param mixed $icon
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
    }

    /**
     * @return mixed
     */
    public function getOwnerId()
    {
        return $this->owner_id;
    }

    /**
     * @param mixed $owner_id
     */
    public function setOwnerId($owner_id)
    {
        $this->owner_id = $owner_id;
    }

    /**
     * @return mixed
     */
    public function getApplicationId()
    {
        return $this->application_id;
    }

    /**
     * @param mixed $application_id
     */
    public function setApplicationId($application_id)
    {
        $this->application_id = $application_id;
    }

    /**
     * @return mixed
     */
    public function getParentId()
    {
        return $this->parent_id;
    }

    /**
     * @param mixed $parent_id
     */
    public function setParentId($parent_id)
    {
        $this->parent_id = $parent_id;
    }

    /**
     * @return mixed
     */
    public function getLastPinTimestamp()
    {
        return $this->last_pin_timestamp;
    }

    /**
     * @param mixed $last_pin_timestamp
     */
    public function setLastPinTimestamp($last_pin_timestamp)
    {
        $this->last_pin_timestamp = $last_pin_timestamp;
    }

}