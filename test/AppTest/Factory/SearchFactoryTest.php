<?php

namespace AppTest\Factory;

use App\Action\SearchAction;
use App\Factory\SearchFactory;
use Interop\Container\ContainerInterface;
use PHPUnit\Framework\TestCase;
use Zend\Expressive\Router\RouterInterface;

class SearchFactoryTest extends TestCase
{
    /** @var ContainerInterface */
    protected $container;

    protected function setUp()
    {
        $this->container = $this->prophesize(ContainerInterface::class);
        
        $router = $this->prophesize(RouterInterface::class);

        $this->container->get(RouterInterface::class)->willReturn($router);
        
        $config = require __DIR__ . '/../../../config/autoload/brewery.global.php';
        $this->container->get('config')->willReturn($config);
    }

    public function testFactoryInstanceOf()
    {    
        $factory = new SearchFactory();

        $this->assertInstanceOf(SearchFactory::class, $factory);

        $searchAction = $factory($this->container->reveal());

        $this->assertInstanceOf(SearchAction::class, $searchAction);
    }
}
