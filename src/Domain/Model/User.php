<?php


namespace Discord\Domain\Model;


class User extends AbstractModel
{
    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $discriminator;

    /**
     * @var string
     */
    private $avatar;

    /**
     * @var bool
     */
    private $bot;

    /**
     * @var bool
     */
    private $system;

    /**
     * @var bool
     */
    private $mfa_enabled;

    /**
     * @var string
     */
    private $locale;

    /**
     * @var bool
     */
    private $verified;

    /**
     * @var string
     */
    private $email;

    /**
     * @var int
     */
    private $flags;

    /**
     * @var int
     */
    private $premium_type;

    /**
     * @var int
     */
    private $public_flags;

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
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
     * @return User
     */
    public function setDiscriminator($discriminator)
    {
        $this->discriminator = $discriminator;
        return $this;
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
     * @return User
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
        return $this;
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
     * @return User
     */
    public function setBot($bot)
    {
        $this->bot = $bot;
        return $this;
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
     * @return User
     */
    public function setSystem($system)
    {
        $this->system = $system;
        return $this;
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
     * @return User
     */
    public function setMfaEnabled($mfa_enabled)
    {
        $this->mfa_enabled = $mfa_enabled;
        return $this;
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
     * @return User
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
        return $this;
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
     * @return User
     */
    public function setVerified($verified)
    {
        $this->verified = $verified;
        return $this;
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
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
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
     * @return User
     */
    public function setFlags($flags)
    {
        $this->flags = $flags;
        return $this;
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
     * @return User
     */
    public function setPremiumType($premium_type)
    {
        $this->premium_type = $premium_type;
        return $this;
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
     * @return User
     */
    public function setPublicFlags($public_flags)
    {
        $this->public_flags = $public_flags;
        return $this;
    }

}