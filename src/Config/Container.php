<?php

namespace App\Config;

use DI\Container as DIContainer;
use DI\ContainerBuilder;

class Container
{
    private DIContainer $container;

    public function build(array $definitions)
    {
        $container = new ContainerBuilder();
        $container->addDefinitions(...$definitions);

        $this->container = $container->build();
    }
}
