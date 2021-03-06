<?php

namespace App\Action;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Router;

class HomePageAction implements ServerMiddlewareInterface
{
    private $router;

    public function __construct(Router\RouterInterface $router)
    {
        $this->router = $router;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        return new JsonResponse([
            'Project' => 'Beer Search Api',
            'Author' => 'Renan Danton de Souza',
        ]);
    }
}
