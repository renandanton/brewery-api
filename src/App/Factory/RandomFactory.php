<?php

namespace App\Factory;

use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Brewery\Service\Api as BreweryApi;
use App\Service\BeerService;
use App\Action\RandomAction;

class RandomFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $router = $container->get(RouterInterface::class);
        $config = $container->get('config');
        $api = new BreweryApi($config);
        $beer = new BeerService($api); 
        return new RandomAction($router, $beer);
    }
}
