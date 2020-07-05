<?php


namespace Discord\Domain\Model;


abstract class AbstractModel
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return AbstractModel
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

}