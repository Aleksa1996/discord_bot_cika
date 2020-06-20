<?php

namespace Discord\Discord\Helper;

class Url
{
    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $scheme;

    /**
     * @var string
     */
    protected $host;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var string
     */
    protected $query;

    /**
     * Url constructor.
     *
     * @param $url
     */
    public function __construct($url)
    {
        $this->url = $url;
        $this->scheme = $this->getUrlPart('scheme');
        $this->host = $this->getUrlPart('host');
        $this->path = $this->getUrlPart('path');
        $this->query = $this->getUrlPart('query');
    }


    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getScheme(): string
    {
        return $this->scheme;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getQuery(): string
    {
        return $this->query;
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
        return $this->getPath() . '?' . $this->getQuery();
    }

    /**
     * Parse & get URL part
     *
     * @param string $part
     *
     * @return mixed
     */
    private function getUrlPart(string $part)
    {
        $parsedUrl = \parse_url($this->url);
        return $parsedUrl[$part] ?? null;
    }
}