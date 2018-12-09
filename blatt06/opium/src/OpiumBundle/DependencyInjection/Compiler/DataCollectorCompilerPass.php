<?php

namespace OpiumBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class DataCollectorCompilerPass implements CompilerPassInterface
{
    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $collectorsToRemove = [
            'data_collector.translation',
            'data_collector.logger',
            'data_collector.twig'
        ];

        foreach ($collectorsToRemove as $collector)
        {
            if (!$container->hasDefinition($collector)) {
                continue;
            }
            $definition = $container->getDefinition($collector);
            $definition->clearTags();
        }
    }
}
