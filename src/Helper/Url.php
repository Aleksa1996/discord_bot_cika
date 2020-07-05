<?php


namespace Discord\Helper;


class Url
{
    /**
     * @var string
     */
    private $scheme;

    /**
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $query;

    /**
     * @var string
     */
    private $port;

    /**
     * @var string
     */
    private $ssl;

    /**
     * @var string
     */
    private $url;

    /**
     * Url constructor.
     *
     * @param $url
     */
    public function __construct($url)
    {
        $this->url = $url;
        $this->buildUrlParts();
    }

    /**
     * Parse & get URL part
     *
     * @param $url
     * @param string $part
     *
     * @return mixed
     */
    private function getUrlPart($url, string $part)
    {
        $parsedUrl = \parse_url($url);
        return $parsedUrl[$part] ?? null;
    }

    /**
     * Build up url parts
     */
    private function buildUrlParts()
    {
        $this->scheme = $this->getUrlPart($this->url, 'scheme');
        $this->host = $this->getUrlPart($this->url, 'host');
        $this->path = $this->getUrlPart($this->url, 'path');
        $this->query = $this->getUrlPart($this->url, 'query');
        $this->port = $this->getUrlPart($this->url, 'port');
        $this->ssl = $this->getUrlPart($this->url, 'ssl');
    }

    /**
     * @return string
     */
    public function getScheme(): string
    {
        return $this->scheme;
    }

    /**
     * @param string $scheme
     * @return Url
     */
    public function setScheme(string $scheme)
    {
        $this->scheme = $scheme;
        return $this;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @param string $host
     * @return Url
     */
    public function setHost(string $host)
    {
        $this->host = $host;
        return $this;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     * @return Url
     */
    public function setPath(string $path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return string
     */
    public function getQuery(): string
    {
        return $this->query;
    }

    /**
     * @param string $query
     * @return Url
     */
    public function setQuery(string $query)
    {
        $this->query = $query;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return Url
     */
    public function setUrl(string $url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return integer
     */
    public function getPort()
    {
        if (in_array($this->scheme, ['wss', 'https'])) {
            return 443;
        }

        if (in_array($this->scheme, ['http', 'ws'])) {
            return 80;
        }

        return 80;
    }

    /**
     * @return boolean
     */
    public function isSSL()
    {
        if (in_array($this->scheme, ['wss', 'https'])) {
            return true;
        }

        return false;
    }

    /**
     * @return string
     */
    public function getPathWithQuery()
    {
        return $this->path . '?' . $this->query;
    }

    /**
     * Replace params in URL
     *
     * @param array $params
     * @param string $paramIdentifier
     *
     * @return string
     */
    public function replaceParams(array $params, $paramIdentifier = ':')
    {
        if (empty($params) || !is_array($params)) {
            return $this->url;
        }

        $paramsWithIdentifiers = [];
        foreach ($params as $pi => $pv) {
            $paramsWithIdentifiers[$paramIdentifier . $pi] = $pv;
        }

        return strtr($this->url, $paramsWithIdentifiers);
    }
}