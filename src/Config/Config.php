<?php


namespace Discord\Config;


class Config
{
    /**
     * @var string
     */
    private $apiEndpoint;

    /**
     * @var string
     */
    private $websocketEndpoint;

    /**
     * @var string
     */
    private $token;

    /**
     * Config constructor.
     *
     * @param string $apiEndpoint
     * @param string $websocketEndpoint
     * @param string $token
     */
    public function __construct(string $apiEndpoint, string $websocketEndpoint, string $token)
    {
        $this->apiEndpoint = $apiEndpoint;
        $this->websocketEndpoint = $websocketEndpoint;
        $this->token = $token;
    }

    /**
     * @return string
     */
    public function getApiEndpoint(): string
    {
        return $this->apiEndpoint;
    }

    /**
     * @param string $apiEndpoint
     * @return Config
     */
    public function setApiEndpoint(string $apiEndpoint): Config
    {
        $this->apiEndpoint = $apiEndpoint;
        return $this;
    }

    /**
     * @return string
     */
    public function getWebsocketEndpoint(): string
    {
        return $this->websocketEndpoint;
    }

    /**
     * @param string $websocketEndpoint
     * @return Config
     */
    public function setWebsocketEndpoint(string $websocketEndpoint): Config
    {
        $this->websocketEndpoint = $websocketEndpoint;
        return $this;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return Config
     */
    public function setToken(string $token): Config
    {
        $this->token = $token;
        return $this;
    }


}