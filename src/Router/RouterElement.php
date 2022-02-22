<?php

namespace KamilCraftApi\Router;

class RouterElement
{
    public string $name;
    private array $uri_root = [];

    public function __construct(
        public string $method_request,
        public string $uri,
        public string $controller,
        public array $attributes = []
    )
    {
        $this->createUriRoot($uri);
    }

    public function name(string $name)
    {
        $this->name = $name;
    }

    public function getUriRoot(): array
    {
        return $this->uri_root;
    }

    public function addAttributes(array $attributes): void
    {
        $this->attributes = array_merge($this->attributes, $attributes);
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function itsMe(array $request_root = []): bool
    {
        if ( count($request_root) !== count($this->getUriRoot()) ) {
            return false;
        }
        $ok = 0;
        $tmpAttributes = [];
        foreach ( $request_root as $key => $root_element ) {
            $localRootElement = $this->getUriRoot()[$key];
            if ( $root_element === $localRootElement ) {
                $ok++;
            } else if ( preg_match('/^:[_a-zA-Z\-]+/i', $localRootElement) ) {
                $arrayKey = explode(':', $localRootElement)[1];
                if ( $arrayKey ) {
                    $tmpAttributes[$arrayKey] = $root_element;
                }
                $ok++;
            } else {
                $tmpAttributes = [];
            }
        }

        if ( count($request_root) === $ok ) {
            $this->addAttributes($tmpAttributes);
            return true;
        }

        return false;
    }

    private function createUriRoot(string $uri): void
    {
        foreach (explode('/', $uri) as $uri_root_element) {
            if ( is_numeric($uri_root_element) || !empty($uri_root_element) ) {
                $this->uri_root[] = $uri_root_element;
            }
        }
    }
}
