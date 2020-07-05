<?php


namespace Discord\Infrastructure\Websocket\Swoole;

use Discord\Infrastructure\Websocket\Payload as BasePayload;
use Swoole\WebSocket\Frame as SwooleFrame;


class Payload extends BasePayload
{
    /**
     * Create Payload object from Swoole frame
     *
     * @param SwooleFrame $frame
     * @return static
     */
    public static function fromFrame(SwooleFrame $frame)
    {
        $frameData = json_decode($frame->data, true);
        return new static(
            $frameData['op'],
            $frameData['d'],
            $frameData['s'],
            $frameData['t']
        );
    }
}