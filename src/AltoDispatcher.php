<?php

namespace Interop\Routing\Alto;

use Interop\Routing\DispatcherInterface;
use Interop\Routing\Route\RouteCollection;
use Psr\Http\Message\ServerRequestInterface;
use AltoRouter;

final class AltoDispatcher implements DispatcherInterface
{
    private AltoRouter $router;

    public function __construct(AltoRouter $router)
    {
        $this->router = $router;
    }

    public function addRoutes(RouteCollection $routes): self
    {
        foreach ($routes as $route) {
            $this->router->map(implode('|', $route->getMethods()), $route->getPath(), $route->getHandler(), $route->getName());
        }

        return $this;
    }

    public function dispatch(ServerRequestInterface $request): callable
    {
        return $this->router->match($request->getUri(), $request->getMethod())['target'];
    }
}
