<?php

use Discord\Application\EventSubscriber\CommandSubscriber;
use Discord\Application\EventSubscriber\MessageSubscriber;
use Discord\Discord;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

require_once __DIR__ . '/../vendor/autoload.php';


$containerBuilder = new ContainerBuilder();
$loader = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__ . '/Config'));
$loader->load('services.yaml');

//$containerBuilder->compile();

$discord = $containerBuilder->get(Discord::class);


$discord->subscribe($containerBuilder->get(MessageSubscriber::class));
$discord->subscribe($containerBuilder->get(CommandSubscriber::class));


//echo json_encode($containerBuilder->getDefinitions(),JSON_PRETTY_PRINT);
$discord->start();
