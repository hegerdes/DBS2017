<?php

namespace OpiumBundle;

use OpiumBundle\DependencyInjection\Compiler\DataCollectorCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class OpiumBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new DataCollectorCompilerPass());
    }
}
