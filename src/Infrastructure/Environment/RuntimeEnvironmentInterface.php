<?php


namespace Discord\Infrastructure\Environment;


interface RuntimeEnvironmentInterface
{
    /**
     * Run app in context
     *
     * @param $callback
     *
     * @return mixed
     */
    public function run($callback);
}