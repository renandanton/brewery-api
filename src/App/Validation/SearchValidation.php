<?php

namespace App\Validation;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Router;

class SearchValidation extends Validation
{
    private $rules = [
      'q' => 'required|alnum',
      'type' => 'required'
    ];

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $data = $request->getQueryParams();

        $this->validate($request, $this->rules);

        if (count($this->messages) > 0) return new JsonResponse($this->messages, 422);

        return $next($request, $response);
    }
}
