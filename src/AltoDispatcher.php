<?php

namespace Interop\Routing\Alto;

use Interop\Routing\DispatcherInterface;
use Psr\Http\Message\ServerRequestInterface;
use AltoRouter;

final class AltoDispatcher implements DispatcherInterface
{
    private AltoRouter $router;

    public function __construct(AltoRouter $router)
    {
        $this->router = $router;
    }

    public function dispatch(ServerRequestInterface $request): callable
    {
        return $this->router->match($request->getUri(), $request->getMethod())['target'];
    }
}
