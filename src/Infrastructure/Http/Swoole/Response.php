<?php


namespace Discord\Infrastructure\Http\Swoole;


use Discord\Infrastructure\Http\ResponseInterface;

class Response implements ResponseInterface
{
    /**
     * @var int
     */
    private $statusCode;

    /**
     * @var array
     */
    private $headers;

    /**
     * @var string
     */
    private $content;

    /**
     * Response constructor.
     *
     * @param int $statusCode
     * @param array $headers
     * @param string $content
     */
    public function __construct(int $statusCode, array $headers, string $content)
    {
        $this->statusCode = $statusCode;
        $this->headers = $headers;
        $this->content = $content;
    }


    /**
     * @inheritDoc
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @inheritDoc
     */
    public function getHeaders(bool $throw = true): array
    {
        return $this->headers;
    }

    /**
     * @inheritDoc
     */
    public function getContent(bool $throw = true): string
    {
        return $this->content;
    }

    /**
     * @inheritDoc
     */
    public function toArray(bool $throw = true): array
    {
        return [
            'statusCode' => $this->getStatusCode(),
            'headers' => $this->getHeaders(),
            'content' => $this->getContent(),
        ];
    }
}