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
     * @var string
     */
    private $commandSymbol;

    /**
     * Config constructor.
     *
     * @param string $apiEndpoint
     * @param string $websocketEndpoint
     * @param string $token
     * @param string $commandSymbol
     */
    public function __construct(string $apiEndpoint, string $websocketEndpoint, string $token, string $commandSymbol)
    {
        $this->apiEndpoint = $apiEndpoint;
        $this->websocketEndpoint = $websocketEndpoint;
        $this->token = $token;
        $this->commandSymbol = $commandSymbol;
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

    /**
     * @return string
     */
    public function getCommandSymbol()
    {
        return $this->commandSymbol;
    }

    /**
     * @param string $commandSymbol
     * @return Config
     */
    public function setCommandSymbol(string $commandSymbol)
    {
        $this->commandSymbol = $commandSymbol;
        return $this;
    }


}