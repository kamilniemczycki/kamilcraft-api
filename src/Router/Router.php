<?php

namespace KamilCraftApi\Router;

use KamilCraftApi\Request\Request;

/**
 * @method RouterElement|null get(string $uri, string $controller, array $attributes = [])
 * @method RouterElement|null post(string $uri, string $controller, array $attributes = [])
 * @method RouterElement|null put(string $uri, string $controller, array $attributes = [])
 * @method RouterElement|null path(string $uri, string $controller, array $attributes = [])
 * @method RouterElement|null delete(string $uri, string $controller, array $attributes = [])
 */

class Router
{
    const METHODS = [
        'get',
        'post',
        'put',
        'path',
        'delete'
    ];
    protected ?RouterCollection $routerCollection;

    public function __construct(
        protected ?Request $request = null
    )
    {
        $this->routerCollection = new RouterCollection();
    }

    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    public function requestIsAdded(): bool
    {
        return isset($this->request);
    }

    public function selectRouter(): RouterElement|null
    {
        return $this->routerCollection->findUri($this->request->getUriRoot(), $this->request);
    }

    private function addToCollection(
        string $method,
        string $uri,
        string $controller,
        array $attributes = []
    ): RouterElement
    {
        $routerElement = new RouterElement($method, $uri, $controller, $attributes);
        $this->routerCollection->add($routerElement);

        return $routerElement;
    }

    public function __call(
        string $name,
        array $arguments
    ): RouterElement|null
    {
        if ( in_array($name, self::METHODS, true) ) {
            $args = array_merge([$name], $arguments);
            return call_user_func_array([$this, 'addToCollection'], $args);
        }

        return null;
    }
}
