<?php


namespace Discord\Discord\Api\Entity;


class User extends AbstractEntity
{
    /**
     * The user's id
     *
     * @var int
     */
    private $id;

    /**
     * The user's username, not unique across the platform
     *
     * @var string
     */
    private $username;

    /**
     * The user's 4-digit discord-tag
     *
     * @var string
     */
    private $discriminator;

    /**
     * The user's avatar hash
     *
     * @var string
     */
    private $avatar;

    /**
     * Whether the user belongs to an OAuth2 application
     *
     * @var bool
     */
    private $bot;

    /**
     * Whether the user is an Official Discord System user (part of the urgent message system)
     *
     * @var bool
     */
    private $system;

    /**
     * Whether the user has two factor enabled on their account
     *
     * @var bool
     */
    private $mfa_enabled;

    /**
     * The user's chosen language option
     *
     * @var string
     */
    private $locale;

    /**
     * Whether the email on this account has been verified
     *
     * @var bool
     */
    private $verified;

    /**
     * The user's email
     *
     * @var string
     */
    private $email;

    /**
     * The flags on a user's account
     *
     * @var int
     */
    private $flags;

    /**
     * The type of Nitro subscription on a user's account
     *
     * @var int
     */
    private $premium_type;

    /**
     * The public flags on a user's account
     *
     * @var int
     */
    private $public_flags;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getDiscriminator()
    {
        return $this->discriminator;
    }

    /**
     * @param string $discriminator
     */
    public function setDiscriminator(string $discriminator)
    {
        $this->discriminator = $discriminator;
    }

    /**
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param string $avatar
     */
    public function setAvatar(string $avatar)
    {
        $this->avatar = $avatar;
    }

    /**
     * @return bool
     */
    public function isBot()
    {
        return $this->bot;
    }

    /**
     * @param bool $bot
     */
    public function setBot(bool $bot)
    {
        $this->bot = $bot;
    }

    /**
     * @return bool
     */
    public function isSystem()
    {
        return $this->system;
    }

    /**
     * @param bool $system
     */
    public function setSystem(bool $system)
    {
        $this->system = $system;
    }

    /**
     * @return bool
     */
    public function isMfaEnabled()
    {
        return $this->mfa_enabled;
    }

    /**
     * @param bool $mfa_enabled
     */
    public function setMfaEnabled(bool $mfa_enabled)
    {
        $this->mfa_enabled = $mfa_enabled;
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param string $locale
     */
    public function setLocale(string $locale)
    {
        $this->locale = $locale;
    }

    /**
     * @return bool
     */
    public function isVerified()
    {
        return $this->verified;
    }

    /**
     * @param bool $verified
     */
    public function setVerified(bool $verified)
    {
        $this->verified = $verified;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
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
     */
    public function setFlags(int $flags)
    {
        $this->flags = $flags;
    }

    /**
     * @return int
     */
    public function getPremiumType()
    {
        return $this->premium_type;
    }

    /**
     * @param int $premium_type
     */
    public function setPremiumType(int $premium_type)
    {
        $this->premium_type = $premium_type;
    }

    /**
     * @return int
     */
    public function getPublicFlags()
    {
        return $this->public_flags;
    }

    /**
     * @param int $public_flags
     */
    public function setPublicFlags(int $public_flags)
    {
        $this->public_flags = $public_flags;
    }


}