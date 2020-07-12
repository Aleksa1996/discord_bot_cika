<?php


namespace Discord\Infrastructure\Persistance\Proxy;


abstract class InMemoryRepositoryProxy
{
    /**
     * @var array
     */
    private $storage = [];


    /**
     * Put key-value pair to in memory storage
     *
     * @param $key
     * @param $value
     *
     * @return InMemoryRepositoryProxy
     */
    public function putInStorage($key, $value)
    {
        $this->storage[$key] = $value;

        return $this;
    }

    /**
     * Get from in memory storage
     *
     * @param $key
     *
     * @return mixed
     */
    public function getFromStorage($key)
    {
        return $this->storage[$key] ?? null;
    }

}