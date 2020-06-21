<?php


namespace Discord\Discord\Api\Repository;


class MessageRepository extends AbstractRepository
{
    protected $endpoints = [
        'get' => '/channels/:channel_id/messages/:id',
        'create' => '/channels/:channel_id/messages',
        'update' => '/channels/:channel_id/messages/:id',
        'delete' => '/channels/:channel_id/messages/:id',
    ];
}