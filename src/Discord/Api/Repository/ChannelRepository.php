<?php


namespace Discord\Discord\Api\Repository;


class ChannelRepository extends AbstractRepository
{
    protected $endpoints = [
        'get' => '/channels/:channel_id',
        'create' => '/channels',
        'update' => '/channels/:channel_id',
        'delete' => '/channels/:channel_id',
    ];
}