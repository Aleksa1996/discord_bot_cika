<?php


namespace Discord\Discord\Api\Http;


use Discord\Discord\Helper\ArrayAccessorTrait;
use Discord\Discord\Helper\Url;

class Request
{
    use ArrayAccessorTrait;

    /**
     * @var string
     */
    private $method;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $body;

    /**
     * @var array
     */
    private $headers;

    /**
     * Request constructor.
     *
     * @param $method
     * @param $url
     * @param $body
     * @param array $headers
     */
    public function __construct($method, $url, $body = null, $headers = [])
    {
        $this->method = $method;
        $this->url = $url;
        $this->body = $body;
        $this->headers = $this->getDefaultHeaders() + $headers;
    }

    /**
     * Get default options
     *
     * @return array
     */
    private function getDefaultHeaders()
    {
        return [
            'User-Agent' => 'swoole-http-client',
            'Accept' => 'application/json',
            'Accept-Encoding' => 'gzip',
            'Content-Type' => 'application/json'
        ];
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param string $method
     * @return Request
     */
    public function setMethod(string $method)
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return Request
     */
    public function setUrl(string $url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $body
     *
     * @return Request
     */
    public function setBody(string $body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     *
     * @return Request
     */
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * @param $key
     * @param $value
     *
     * @return Request
     */
    public function addHeader($key, $value)
    {
        $this->headers[$key] = $value;
        return $this;
    }

    /**
     * @param $key
     *
     * @return Request
     */
    public function removeHeader($key)
    {
        unset($this->headers[$key]);
        return $this;
    }

    /**
     * @return string
     */
    public function getScheme()
    {
        return Url::getScheme($this->url);
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return Url::getHost($this->url);
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return Url::getPath($this->url);
    }

    /**
     * @return string
     */
    public function getQuery()
    {
        return Url::getQuery($this->url);
    }

    /**
     * @return string
     */
    public function isSsl()
    {
        return Url::isSSL($this->url);
    }

    /**
     * @return int
     */
    public function getPort()
    {
        return Url::getPort($this->url);
    }

}