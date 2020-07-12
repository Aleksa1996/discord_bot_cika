<?php


namespace Discord\Application\Service;


use ReflectionParameter;

class MapperService
{
    /**
     * @var string
     */
    private $accessPrefix = 'get';

    /**
     * @var string
     */
    private $mutatorPrefix = 'set';

    /**
     * Map array to object
     *
     * @param $array
     * @param $class
     * @return mixed
     */
    public function map($array, $class)
    {
        return $this->fill(new $class(), $array);
    }

    /**
     * Fill object with data
     *
     * @param $object
     * @param $array
     * @return mixed
     */
    protected function fill($object, $array)
    {
        foreach ($array as $field => $value) {

            $mutator = $this->getMutator($field);

            if (method_exists($object, $mutator)) {
                $resolvedValue = $this->resolveValue($object, $mutator, $value);
                $object->$mutator($resolvedValue);
            }
        }

        return $object;
    }

    /**
     * Generate mutator name
     *
     * @param $name
     * @return string
     */
    protected function getMutator($name)
    {
        return $this->mutatorPrefix . implode('', array_map('ucfirst', explode('_', $name)));
    }

    /**
     * Resolve value
     *
     * @param $object
     * @param $mutator
     * @param $value
     *
     * @return mixed
     */
    protected function resolveValue($object, $mutator, $value)
    {
        try {
            $param = new ReflectionParameter([get_class($object), $mutator], 0);
        } catch (\ReflectionException $e) {
            return $value;
        }

        if ($param->getClass() === null) {
            return $value;
        }

        return $this->map($value, $param->getClass()->name);
    }
}