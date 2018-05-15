<?php

namespace AppTest\Factory;

use App\Action\RandomAction;
use App\Factory\RandomFactory;
use Interop\Container\ContainerInterface;
use PHPUnit\Framework\TestCase;
use Zend\Expressive\Router\RouterInterface;

class RandomFactoryTest extends TestCase
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

    public function testFactoryWithoutTemplate()
    {    
        $factory = new RandomFactory();

        $this->assertInstanceOf(RandomFactory::class, $factory);

        $randomAction = $factory($this->container->reveal());

        $this->assertInstanceOf(RandomAction::class, $randomAction);
    }
}
