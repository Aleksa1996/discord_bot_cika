<?php


namespace Discord\Infrastructure\Http;


use Discord\Infrastructure\Http\Exception\HttpClientException;

interface ResponseInterface
{
    /**
     * Gets the HTTP status code of the response.
     *
     */
    public function getStatusCode(): int;

    /**
     * Gets the HTTP headers of the response.
     *
     * @param bool $throw Whether an exception should be thrown on 3/4/5xx status codes
     *
     * @return string[][] The headers of the response keyed by header names in lowercase
     *
     * @throws HttpClientException   When a network error occurs
     */
    public function getHeaders(bool $throw = true): array;

    /**
     * Gets the response body as a string.
     *
     * @param bool $throw Whether an exception should be thrown on 3/4/5xx status codes
     *
     * @return string
     *
     * @throws HttpClientException   When a network error occurs
     */
    public function getContent(bool $throw = true): string;

    /**
     * Gets the response body decoded as array, typically from a JSON payload.
     *
     * @param bool $throw Whether an exception should be thrown on 3/4/5xx status codes
     *
     * @return array
     *
     * @throws HttpClientException   When a network error occurs
     */
    public function toArray(bool $throw = true): array;
}