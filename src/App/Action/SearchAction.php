<?php

namespace App\Action;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Router;
use App\Service\BeerService;

class SearchAction implements ServerMiddlewareInterface
{
    private $router;

    private $service;


    public function __construct(
      Router\RouterInterface $router,
      \App\Service\BeerService $service
    )
    {
        $this->router   = $router;
        $this->service = $service;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $params = $request->getQueryParams();

        $beers = $this->service->search($params);

        return new JsonResponse($beers);
    }
}
