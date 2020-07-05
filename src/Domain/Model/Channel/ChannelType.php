<?php


namespace Discord\Domain\Model\Channel;


class ChannelType
{
    public const GUILD_TEXT = 0;
    public const DM = 1;
    public const GUILD_VOICE = 2;
    public const GROUP_DM = 3;
    public const GUILD_CATEGORY = 4;
    public const GUILD_NEWS = 5;
    public const GUILD_STORE = 6;

    /**
     * @var int
     */
    private $value;

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param int $value
     * @return ChannelType
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

}