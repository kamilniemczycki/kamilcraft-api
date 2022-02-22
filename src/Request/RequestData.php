<?php

namespace KamilCraftApi\Request;

class RequestData
{
    protected array $data = [
        'get' => [],
        'post' => [],
        'json' => [],
        'other' => []
    ];

    public function add(string $type, array $data = []): void
    {
        if ( array_key_exists($type, $this->data) ) {
            array_push($this->data[$type], $data);
        } else {
            array_push($this->data['other'], $data);
        }
    }

    public function get(string $type, string $name): array|null
    {
        $key = array_search($name, array_column($this->data[$type], 'name'));

        return $this->data[$type][$key] ?? null;
    }
}
