<?php

namespace KamilCraftApi\Router;

use KamilCraftApi\Request\Request;

class RouterCollection
{
    private array $collection;

    public function add(RouterElement $routerElement): void
    {
        $this->collection[] = $routerElement;
    }

    /**
     * @return array<RouterElement>|null
     */
    public function getAll(): array|null
    {
        return $this->collection ?? null;
    }

    public function findUri(array $request_uri_root, Request $request): RouterElement|null
    {
        foreach ($this->getAll() as $routerElement) {
            /** @var RouterElement $routerElement */
            if (
                $routerElement->itsMe($request_uri_root) &&
                $routerElement->method_request === strtolower($request->getMethod())
            ) {
                return $routerElement;
            }
        }

        return null;
    }

    public function get(string $name): RouterElement|null
    {
        foreach ( $this->collection as $routeElement ) {
            /** @var RouterElement $routeElement */
            if ( $routeElement->name === $name ) {
                return $routeElement;
            }
        }
        return null;
    }
}
