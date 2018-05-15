<?php

namespace App\Service;

use Fig\Http\Message\RequestMethodInterface as RequestMethod;
use Fig\Http\Message\StatusCodeInterface as StatusCode;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response;
use Zend\Expressive\Router\RouteResult;


class CorsService implements ServerMiddlewareInterface
{
    /**
     * @var null|ResponseInterface
     */
    private $response;

    /**
     * @param null|ResponseInterface $response Response prototype to use for
     *     implicit OPTIONS requests; if not provided a zend-diactoros Response
     *     instance will be created and used.
     */
    public function __construct(ResponseInterface $response = null)
    {
        $this->response = $response;
    }

    /**
     * Handle an implicit OPTIONS request.
     *
     * @param ServerRequestInterface $request
     * @param DelegateInterface $delegate
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        
        $req = $delegate->process($request);

        $this->response = new Response($req->getBody(), StatusCode::STATUS_OK);

        return $this->getResponse($request->getBody())
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Content-Type', 'application/json')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Origin, Accept, Authorization, X-Requested-With');

    }

    /**
     * Return the response prototype to use for an implicit OPTIONS request.
     *
     * @param  Zend\Diactoros\Stream
     * @return ResponseInterface
     */
    private function getResponse($stream)
    {
        return $this->response ?: new Response($stream, StatusCode::STATUS_OK);
    }
}
