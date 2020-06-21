<?php


namespace Discord\Discord\Api\Entity;


class Overwrite extends AbstractEntity
{
    /**
     * Role or user id
     *
     * @var int
     */
    private $id;

    /**
     * Either "role" or "member"
     *
     * @var string
     */
    private $type;

    /**
     * Permission bit set
     *
     * @var int
     */
    private $allow;

    /**
     * Permission bit set
     *
     * @var int
     */
    private $deny;

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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getAllow()
    {
        return $this->allow;
    }

    /**
     * @param int $allow
     */
    public function setAllow(int $allow)
    {
        $this->allow = $allow;
    }

    /**
     * @return int
     */
    public function getDeny()
    {
        return $this->deny;
    }

    /**
     * @param int $deny
     */
    public function setDeny(int $deny)
    {
        $this->deny = $deny;
    }


}