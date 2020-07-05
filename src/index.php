<?php

use Discord\Application\EventSubscriber\MessageSubscriber;
use Discord\Discord;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

require_once __DIR__ . '/../vendor/autoload.php';


$containerBuilder = new ContainerBuilder();
$loader = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__ . '/Config'));
$loader->load('services.yaml');

$discord = $containerBuilder->get(Discord::class);

$discord->subscribe($containerBuilder->get(MessageSubscriber::class));

$discord->start();

//$discord->on('message.created', function (Discord\Infrastructure\Websocket\Event\MessageCreated $message) {
//    var_dump($message->getMessage()->getId());
//    var_dump($message->getMessage()->getContent());
////    var_dump($message->getMessage()->getAuthor());
//
//});
//
