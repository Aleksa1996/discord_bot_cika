<?php


namespace Discord\Infrastructure\Http\Swoole;


use Discord\Helper\Url;
use Discord\Infrastructure\Http\Exception\HttpClientException;
use Discord\Infrastructure\Http\HttpClientInterface;
use Discord\Infrastructure\Http\ResponseInterface;
use Discord\Infrastructure\Swoole\SwooleHttpClientFactory;

class HttpClient implements HttpClientInterface
{
    /**
     * @inheritDoc
     *
     * @throws HttpClientException
     */
    public function request(string $method, string $url, array $options = []): ResponseInterface
    {
        $method = strtolower($method);

        if (!method_exists($this, $method)) {
            throw new HttpClientException('Provided method does not exists.');
        }

        return $this->$method($url, $options);
    }

    /**
     * Send get request
     *
     * @param $url
     * @param $options
     *
     * @return Response
     */
    private function get($url, $options)
    {
        $urlHelper = new Url($url);
        $client = SwooleHttpClientFactory::create($url, $options['headers'] ?? []);

        $client->get($urlHelper->getPathWithQuery());

        $response = $this->createResponseFromClient($client);

        $client->close();

        return $response;
    }

    /**
     * Send post request
     *
     * @param $url
     * @param $options
     *
     * @return Response
     */
    private function post($url, $options)
    {
        $urlHelper = new Url($url);
        $client = SwooleHttpClientFactory::create($url, $options['headers'] ?? []);

        $client->post(
            $urlHelper->getPathWithQuery(),
            $options['body'] ?? ''
        );

        $response = $this->createResponseFromClient($client);

        $client->close();

        return $response;
    }

    /**
     * Create response
     *
     * @param $client
     * @return Response
     */
    private function createResponseFromClient($client)
    {
        return new Response(
            $client->getStatusCode(),
            $client->getHeaders(),
            $client->getBody()
        );
    }
}