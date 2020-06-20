<?php


namespace Discord\Discord\Websocket\Swoole;

use Discord\Discord\Websocket\AbstractPayload;
use Swoole\WebSocket\Frame as SwooleFrame;


class Payload extends AbstractPayload
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