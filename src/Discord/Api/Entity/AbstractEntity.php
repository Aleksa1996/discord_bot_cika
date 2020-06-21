<?php


namespace Discord\Discord\Api\Entity;


class AbstractEntity implements \JsonSerializable
{
    /**
     * @var string[]
     */
    protected $serializableFields = [];

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return $this->getSerializableFieldsWithValues();
    }

    /**
     * Get serializable fields
     *
     * @return string[]
     */
    public function getSerializableFields()
    {
        return $this->serializableFields;
    }

    /**
     * Get serializable fields
     *
     * @return array
     *
     * @throws \ReflectionException
     */
    public function getSerializableFieldsWithValues()
    {
        $data = [];
        $reflection = new \ReflectionClass($this);

        foreach ($this->serializableFields as $serializableField) {
            $property = $reflection->getProperty($serializableField);
            $property->setAccessible(true);

            $data[$serializableField] = $property->getValue($this);
        }

        return $data;
    }
}