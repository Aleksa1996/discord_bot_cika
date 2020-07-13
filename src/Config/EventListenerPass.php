<?php


namespace Discord\Config;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\EventDispatcher\EventDispatcher;

class EventListenerPass implements CompilerPassInterface
{

    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has(EventDispatcher::class)) {
            return;
        }

        $definition = $container->findDefinition(EventDispatcher::class);

        $taggedServices = $container->findTaggedServiceIds('event.listener');

        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall('addSubscriber', [new Reference($id)]);
        }
    }
}