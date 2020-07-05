<?php


namespace Discord\Domain\Model\Message;


use Discord\Domain\Model\AbstractModel;
use Discord\Domain\Model\Channel\Channel;
use Discord\Domain\Model\Timestamp;
use Discord\Domain\Model\User;

class Message extends AbstractModel
{
    /**
     * @var int
     */
    private $channel_id;

    /**
     * @var int
     */
    private $guild_id;

    /**
     * @var User
     */
    private $author;

    /**
     * @var mixed
     */
    private $member;

    /**
     * @var string
     */
    private $content;

    /**
     * @var Timestamp
     */
    private $timestamp;

    /**
     * @var Timestamp
     */
    private $edited_timestamp;

    /**
     * @var bool
     */
    private $tts;

    /**
     * @var bool
     */
    private $mention_everyone;

    /**
     * @var User[]
     */
    private $mentions;

    /**
     * @var mixed
     */
    private $mention_roles;

    /**
     * @var mixed
     */
    private $mention_channels;

    /**
     * @var mixed
     */
    private $attachments;

    /**
     * @var mixed
     */
    private $embeds;

    /**
     * @var mixed
     */
    private $reactions;

    /**
     * @var mixed
     */
    private $nonce;

    /**
     * @var bool
     */
    private $pinned;

    /**
     * @var int
     */
    private $webhook_id;

    /**
     * @var int
     */
    private $type;

    /**
     * @var mixed
     */
    private $activity;

    /**
     * @var mixed
     */
    private $application;

    /**
     * @var mixed
     */
    private $message_reference;

    /**
     * @var int
     */
    private $flags;

    /**
     * @return int
     */
    public function getChannelId()
    {
        return $this->channel_id;
    }

    /**
     * @param $channel_id
     * @return Message
     */
    public function setChannelId($channel_id)
    {
        $this->channel_id = $channel_id;
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
     * @return Message
     */
    public function setGuildId($guild_id)
    {
        $this->guild_id = $guild_id;
        return $this;
    }

    /**
     * @return User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param User $author
     * @return Message
     */
    public function setAuthor(User $author)
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMember()
    {
        return $this->member;
    }

    /**
     * @param mixed $member
     * @return Message
     */
    public function setMember($member)
    {
        $this->member = $member;
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
     * @return Message
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return string
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @param string $timestamp
     * @return Message
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
        return $this;
    }

    /**
     * @return string
     */
    public function getEditedTimestamp()
    {
        return $this->edited_timestamp;
    }

    /**
     * @param string $edited_timestamp
     * @return Message
     */
    public function setEditedTimestamp($edited_timestamp)
    {
        $this->edited_timestamp = $edited_timestamp;
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
     * @return Message
     */
    public function setTts($tts)
    {
        $this->tts = $tts;
        return $this;
    }

    /**
     * @return bool
     */
    public function isMentionEveryone()
    {
        return $this->mention_everyone;
    }

    /**
     * @param bool $mention_everyone
     * @return Message
     */
    public function setMentionEveryone($mention_everyone)
    {
        $this->mention_everyone = $mention_everyone;
        return $this;
    }

    /**
     * @return User[]
     */
    public function getMentions()
    {
        return $this->mentions;
    }

    /**
     * @param User[] $mentions
     * @return Message
     */
    public function setMentions(array $mentions)
    {
        $this->mentions = $mentions;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMentionRoles()
    {
        return $this->mention_roles;
    }

    /**
     * @param mixed $mention_roles
     * @return Message
     */
    public function setMentionRoles($mention_roles)
    {
        $this->mention_roles = $mention_roles;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMentionChannels()
    {
        return $this->mention_channels;
    }

    /**
     * @param mixed $mention_channels
     * @return Message
     */
    public function setMentionChannels($mention_channels)
    {
        $this->mention_channels = $mention_channels;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAttachments()
    {
        return $this->attachments;
    }

    /**
     * @param mixed $attachments
     * @return Message
     */
    public function setAttachments($attachments)
    {
        $this->attachments = $attachments;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmbeds()
    {
        return $this->embeds;
    }

    /**
     * @param mixed $embeds
     * @return Message
     */
    public function setEmbeds($embeds)
    {
        $this->embeds = $embeds;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReactions()
    {
        return $this->reactions;
    }

    /**
     * @param mixed $reactions
     * @return Message
     */
    public function setReactions($reactions)
    {
        $this->reactions = $reactions;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNonce()
    {
        return $this->nonce;
    }

    /**
     * @param mixed $nonce
     * @return Message
     */
    public function setNonce($nonce)
    {
        $this->nonce = $nonce;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPinned()
    {
        return $this->pinned;
    }

    /**
     * @param bool $pinned
     * @return Message
     */
    public function setPinned($pinned)
    {
        $this->pinned = $pinned;
        return $this;
    }

    /**
     * @return int
     */
    public function getWebhookId()
    {
        return $this->webhook_id;
    }

    /**
     * @param int $webhook_id
     * @return Message
     */
    public function setWebhookId($webhook_id)
    {
        $this->webhook_id = $webhook_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $type
     * @return Message
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getActivity()
    {
        return $this->activity;
    }

    /**
     * @param mixed $activity
     * @return Message
     */
    public function setActivity($activity)
    {
        $this->activity = $activity;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getApplication()
    {
        return $this->application;
    }

    /**
     * @param mixed $application
     * @return Message
     */
    public function setApplication($application)
    {
        $this->application = $application;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMessageReference()
    {
        return $this->message_reference;
    }

    /**
     * @param mixed $message_reference
     * @return Message
     */
    public function setMessageReference($message_reference)
    {
        $this->message_reference = $message_reference;
        return $this;
    }

    /**
     * @return int
     */
    public function getFlags()
    {
        return $this->flags;
    }

    /**
     * @param int $flags
     * @return Message
     */
    public function setFlags($flags)
    {
        $this->flags = $flags;
        return $this;
    }


}