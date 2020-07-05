<?php


namespace Discord\Infrastructure\Swoole;


use Discord\Helper\Url;
use Swoole\Coroutine\Http\Client;

class SwooleHttpClientFactory
{
    /**
     * @param $url
     * @param $headers
     *
     * @return Client
     */
    public static function create($url, $headers = [])
    {
        $url = new Url($url);

        $client = new Client(
            $url->getHost(),
            $url->getPort(),
            $url->isSSL()
        );

        $defaultHeaders = [
            'Host' => $url->getHost() . ':' . $url->getPort(),
        ];

        $headers = array_merge($defaultHeaders, $headers);

        $client->setHeaders($headers);

        return $client;
    }
}