<?php

namespace AppTest\Service;

use App\Service\BeerService;
use Brewery\Service\Api as BreweryApi;
use Interop\Container\ContainerInterface;
use PHPUnit\Framework\TestCase;
use Zend\Expressive\Router\RouterInterface;

class BeerServiceTest extends TestCase
{
    /** @var ContainerInterface */
    protected $container;
    
    /** @var  App\Service\BeerService */
    protected $beer;
    
    protected $config;

    protected function setUp()
    {
        $this->container = $this->prophesize(ContainerInterface::class);
        
        $beer = $this->prophesize(BeerService::class);
        
        $this->container->get(BeerService::class)->willReturn($beer);
        
        $this->config = require __DIR__ . '/../../../config/autoload/brewery.global.php';
        $this->container->get('config')->willReturn($this->config);
    }

    public function testServiceInstanceOf()
    {    
        $service = new BeerService(new BreweryApi($this->config));

        $this->assertInstanceOf(BeerService::class, $service);
    }
    
    public function testServiceRandom()
    {
        $service = new BeerService(new BreweryApi($this->config));
        $params = ['q' => 'Smithwicks', 'type' => 'beer'];
        $result = json_encode($service->search($params));
        
        $this->assertNotEmpty($result);
        $this->assertGreaterThan(0, count(json_decode($result)));
    }
    
    public function testServiceSearchBeerWithParams()
    {
        $service = new BeerService(new BreweryApi($this->config));
        $params = ['q' => 'Smithwicks', 'type' => 'beer'];
        $result = json_encode($service->search($params));
        
        $this->assertNotEmpty($result);
        $this->assertGreaterThan(0, count(json_decode($result)));
    }
    
    public function testServiceSearchWithoutParamQ()
    {
        $service = new BeerService(new BreweryApi($this->config));
        $params = ['type' => 'beer'];
        $result = $service->search($params);
      
        $this->assertEquals(
          'The data passed to this method was invalid', 
          $result->errorMessage
        );
        
        $this->assertEquals('failure', $result->status);
    }
    
    public function testServiceSearchWithoutParamType()
    {
        $service = new BeerService(new BreweryApi($this->config));
        $params = ['q' => 'Smithwicks'];
        $result = json_encode($service->search($params));
        
        $this->assertNotEmpty($result);
        $this->assertGreaterThan(0, count(json_decode($result)));
    }
}
