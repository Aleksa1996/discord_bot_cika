<?php


namespace Discord\Discord\Api\Http;


use Discord\Discord\Exception\HttpClientException;

abstract class AbstractHttpClient
{
    /**
     * Get HTTP method
     *
     * @param Request $request
     *
     * @return mixed
     */
    protected abstract function get(Request $request);

    /**
     * Post HTTP method
     *
     * @param Request $request
     *
     * @return mixed
     */
    protected abstract function post(Request $request);

    /**
     * Execute request
     *
     * @param Request $request
     *
     * @return mixed
     *
     * @throws HttpClientException
     */
    public function request(Request $request)
    {
        $method = strtolower($request->getMethod());

        if (method_exists($this, $method)) {
            return $this->{$method}($request);
        }

        throw new HttpClientException('Cannot handle request. Request method not found.');
    }
}