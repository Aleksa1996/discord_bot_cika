<?php


namespace Discord\Domain\Model;


class Timestamp
{
    /**
     * @var string
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
     * @return Timestamp
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

}