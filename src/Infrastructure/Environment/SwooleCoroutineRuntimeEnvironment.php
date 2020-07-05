<?php


namespace Discord\Infrastructure\Environment;


use Swoole\Event as SwooleEvent;
use function Swoole\Coroutine\run as SwooleCoroutineRun;

class SwooleCoroutineRuntimeEnvironment implements RuntimeEnvironmentInterface
{

    /**
     * @inheritDoc
     */
    public function run($callback)
    {
        SwooleCoroutineRun($callback);
        SwooleEvent::wait();
    }
}