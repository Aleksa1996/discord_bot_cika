<?php

namespace Discord\Infrastructure\Websocket\Swoole;

use Discord\Application\Service\MapperService;
use Discord\Config\Config;
use Discord\Infrastructure\Swoole\SwooleHttpClientFactory;
use Discord\Infrastructure\Websocket\Exception\WebsocketClientException;
use Discord\Helper\Url;
use Discord\Infrastructure\Websocket\Payload;
use Discord\Infrastructure\Websocket\Swoole\Payload as SwoolePayload;
use Discord\Infrastructure\Websocket\AbstractWebsocketClient;
use Swoole\Coroutine;
use Swoole\Coroutine\Http\Client as SwooleHttpClient;
use Swoole\Timer as SwooleTimer;
use Swoole\Websocket\CloseFrame;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class WebsocketClient extends AbstractWebsocketClient
{
    /**
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    /**
     * @var SwooleHttpClient
     */
    private $swooleHttpClient;

    /**
     * WebsocketClient constructor.
     *
     * @param Config $config
     * @param EventDispatcherInterface $eventDispatcher
     * @param MapperService $mapperService
     */
    public function __construct(Config $config, EventDispatcherInterface $eventDispatcher, MapperService $mapperService)
    {
        parent::__construct($config, $eventDispatcher, $mapperService);
        $this->swooleHttpClient = $this->createSwooleHttpClient();
    }

    /**
     * Setup swoole http client
     */
    private function createSwooleHttpClient()
    {
        $headers = [
            'User-Agent' => 'websocket-client-php'
        ];
        return SwooleHttpClientFactory::create($this->config->getWebsocketEndpoint(), $headers);
    }

    /**
     * @inheritDoc
     */
    public function connect()
    {
        $url = new Url($this->config->getWebsocketEndpoint());

        $this
            ->swooleHttpClient
            ->upgrade($url->getPathWithQuery());
    }

    /**
     * @inheritDoc
     */
    public function heartBeat()
    {
        $helloPayload = $this->read();
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
     *
     */
    private function heartBeatTick($timerId)
    {
        $this->push(
            new Payload(Payload::EVENT['HEARTBEAT'])
        );
    }

    /**
     * @inheritDoc
     */
    protected function identify()
    {
        $identifyData = [
            'token' => $this->config->getToken(),
            'properties' => [
                '$os' => 'linux',
                'browser' => 'my_library',
                '$device' => 'my_library'
            ]
        ];

        $this->push(new SwoolePayload(2, $identifyData));
    }

    /**
     * @inheritDoc
     */
    public function push(Payload $payload)
    {
        return $this->swooleHttpClient->push(json_encode($payload));
    }

    /**
     * @inheritDoc
     */
    public function read()
    {
        $frame = $this->swooleHttpClient->recv();


        if ($frame instanceof CloseFrame) {
            var_dump($frame);
        }

        return SwoolePayload::fromFrame($frame);
    }

    /**
     * Listen for events
     *
     * @throws WebsocketClientException
     */
    public function listen()
    {
        while ($payload = $this->read()) {

            if ($payload->getEventName() !== null) {
                $this->dispatchEvent($payload->getEventName(), $payload);
            }

            Coroutine::sleep(0.5);
        }
    }

}