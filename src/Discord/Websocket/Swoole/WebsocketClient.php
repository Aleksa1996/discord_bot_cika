<?php

namespace Discord\Discord\Websocket\Swoole;

use Discord\Discord\Api\Http\Request;
use Discord\Discord\Exception\WebsocketClientException;
use Discord\Discord\Helper\Url;
use Discord\Discord\Websocket\AbstractPayload;
use Discord\Discord\Websocket\AbstractWebsocketClient;
use Swoole\Coroutine;
use Swoole\Coroutine\Http\Client as SwooleHttpClient;
use Swoole\Event as SwooleEvent;
use Swoole\Timer as SwooleTimer;
use function Swoole\Coroutine\run as SwooleCoroutineRun;

class WebsocketClient extends AbstractWebsocketClient
{
    /**
     * @var SwooleHttpClient
     */
    private $swooleHttpClient;

    /**
     * WebsocketClient constructor.
     *
     * @param string $endpoint
     * @param string $token
     */
    public function __construct(string $endpoint, string $token)
    {
        parent::__construct($endpoint, $token);

        $this->setupSwooleHttpClient();
    }

    /**
     * Setup swoole http client
     */
    private function setupSwooleHttpClient()
    {
        $host = Url::getHost($this->endpoint);
        $port = Url::getPort($this->endpoint);
        $ssl = Url::isSSL($this->endpoint);

        $this->swooleHttpClient = new SwooleHttpClient(
            $host,
            $port,
            $ssl
        );

        $this
            ->swooleHttpClient
            ->setHeaders([
                'Host' => $host . ':' . $port,
                'User-Agent' => 'websocket-client-php'
            ]);
    }

    /**
     * @inheritDoc
     */
    protected function upgrade()
    {
        return $this
            ->swooleHttpClient
            ->upgrade(Url::getPathWithQuery($this->endpoint));
    }

    /**
     * @inheritDoc
     *
     * @throws WebsocketClientException
     */
    protected function heartBeat()
    {
        $helloPayload = $this->receivePayload();
        $heartBeatInterval = $helloPayload->getEventData('heartbeat_interval');

        if ($heartBeatInterval === null) {
            throw new WebsocketClientException('No heartbeat interval received from discord server.');
        }

        SwooleTimer::tick($heartBeatInterval, function ($timerId) {
            $this->heartBeatTick($timerId);
        });
    }

    /**
     * Callback function on tick
     *
     * @param $timerId
     */
    private function heartBeatTick($timerId)
    {
        $this->pushPayload(
            new Payload(Payload::HEARTBEAT)
        );
    }

    /**
     * @inheritDoc
     */
    protected function identify()
    {
        $payloadData = [
            'token' => $this->token,
            'properties' => [
                '$os' => 'linux',
                '$browser' => 'my_library',
                '$device' => 'my_library'
            ]
        ];

        $this->pushPayload(
            new Payload(Payload::IDENTIFY, $payloadData)
        );
    }

    /**
     * @inheritDoc
     */
    protected function loop()
    {
        while (true) {
            $payload = $this->receivePayload();

            if ($payload->getEventName() !== null) {
                $this->dispatchEvent($payload->getEventName(), $payload);
            }

            Coroutine::sleep(0.5);
        }
    }

    /**
     * @inheritDoc
     */
    public function start()
    {
        SwooleCoroutineRun(function () {
            parent::start();
        });

        SwooleEvent::wait();
    }

    /**
     * Get received payload
     *
     * @return AbstractPayload
     */
    private function receivePayload()
    {
        $frame = $this->swooleHttpClient->recv();

        if ($frame instanceof \Swoole\Websocket\CloseFrame) {
            var_dump($frame);
        } else {
            return Payload::fromFrame($frame);
        }
    }

    /**
     * Push payload
     *
     * @param AbstractPayload $payload
     *
     * @return boolean
     */
    private function pushPayload(AbstractPayload $payload)
    {
        return $this->swooleHttpClient->push((string)$payload);
    }

}