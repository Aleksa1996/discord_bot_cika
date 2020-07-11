<?php


namespace Discord\Infrastructure\Persistance\Api;


use Discord\Domain\Model\Channel\Channel;
use Discord\Domain\Repository\ChannelRepositoryInterface;
use Discord\Helper\Url;
use Discord\Infrastructure\Http\Exception\HttpClientException;

class ChannelRepository extends ApiRepository implements ChannelRepositoryInterface
{
    /**
     * @var array
     */
    private static $endpoints = [
        'get' => '/channels/:channel_id',
        'update' => '/channels/:channel_id',
    ];

    /**
     *
     * @param $id
     *
     * @return Channel|null
     */
    public function findById($id)
    {
        try {
            $url = new Url($this->config->getApiEndpoint() . static::$endpoints['get']);
            $replacedParamsUrl = $url->replaceParams(['channel_id' => $id]);
            $headers = [
                'Authorization' => 'Bot ' . $this->config->getToken()
            ];

            $response = $this->httpClient->request('GET', $replacedParamsUrl, ['headers' => $headers]);

            if ($response->getStatusCode() != 200) {
                return null;
            }

            $data = json_decode($response->getContent(), true);
            return $this->mapperService->map($data, Channel::class);
        } catch (HttpClientException $e) {
            return null;
        }
    }
}