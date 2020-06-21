<?php


namespace Discord\Discord\Api\Http\Swoole;


use Discord\Discord\Api\Http\AbstractHttpClient;
use Discord\Discord\Api\Http\Request;
use Swoole\Coroutine\HTTP\Client;

class HttpClient extends AbstractHttpClient
{

    /**
     * @inheritDoc
     */
    protected function get(Request $request)
    {
        go(function () use ($request) {
            $cli = new Client(
                $request->getHost(),
                $request->getPort(),
                $request->isSSL()
            );

            $cli->setHeaders(
                $request->getHeaders()
            );

            $cli->get(
                $request->getPath()
            );

            $cli->close();
        });
    }

    /**
     * @inheritDoc
     */
    protected function post(Request $request)
    {
        go(function () use ($request) {
            $cli = new Client(
                $request->getHost(),
                $request->getPort(),
                $request->isSSL()
            );

            $cli->setHeaders(
                $request->getHeaders()
            );

            $cli->post(
                $request->getPath(),
                $request->getBody()
            );

            var_dump($cli->body);
            $cli->close();
        });
    }
}