<?php

namespace AppTest\Action;

use App\Action\SearchAction;
use App\Service\BeerService;
use Interop\Http\ServerMiddleware\DelegateInterface;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Router\RouterInterface;

class SearchActionTest extends TestCase
{
    /** @var RouterInterface */
    protected $router;
    
    /** @var App\Service\Beer */
    protected $beer;

    protected function setUp()
    {
        $this->router = $this->prophesize(RouterInterface::class);
        $this->beer = $this->prophesize(BeerService::class);
    }

    public function testReturnsJsonResponseWhenNoTemplateRendererProvided()
    {
        $searchAction = new SearchAction($this->router->reveal(), $this->beer->reveal());
        $response = $searchAction->process(
            $this->prophesize(ServerRequestInterface::class)->reveal(),
            $this->prophesize(DelegateInterface::class)->reveal()
        );

        $this->assertInstanceOf(JsonResponse::class, $response);
    }
}
