<?php

namespace Brewery\Factory;

use Brewry\Service\Api as BreweryDb;

class BreweryFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');
        return new BreweryDb($config);
    }
}
