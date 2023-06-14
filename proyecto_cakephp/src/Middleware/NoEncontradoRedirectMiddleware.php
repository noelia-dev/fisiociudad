<?php
/**
 * Control de URL con acciones no disponibles. Redirigimos al index
 */
namespace App\Middleware;

use Cake\Http\Response;
use Cake\Http\ServerRequest;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class NoEncontradoRedirectMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            $response = $handler->handle($request);
        } catch (\Cake\Http\Exception\MissingControllerException $exception) {
            $response = new Response();
            return $response->withLocation('/');
        }
        return $response;
    }
}
