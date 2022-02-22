<?php

namespace KamilCraftApi\Request;

class Request
{
    protected array $request = [
        'method' => '',
        'uri' => '',
        'attributes' => [],
        'content_type' => ''
    ];
    protected array $uri_root = [];

    public function __construct(
        protected array $request_data
    )
    {
        $this->request['method'] = $this->request_data['REQUEST_METHOD'];
        $this->request['uri'] = explode('?', $this->request_data['REQUEST_URI'])[0];

        $this->setAttributes();
        $this->setContentType();
        $this->createUriRoot($this->getUri());
    }

    public function getMethod(): string
    {
        return $this->request['method'];
    }

    public function getUri(): string
    {
        return $this->request['uri'];
    }

    public function getAttributes(): RequestData
    {
        return $this->request['attributes'];
    }

    public function getUriRoot(): array
    {
        return $this->uri_root;
    }

    private function setAttributes()
    {
        $requestData = new RequestData();
        $this->setGetAttributes($requestData);
        $this->setPostAttributes($requestData);
        $this->request['attributes'] = $requestData;
    }

    private function setGetAttributes(RequestData $requestData)
    {
        foreach ( $_GET ?? [] as $name => $value ) {
            $requestData->add('get', [ 'name' => $name, 'value' => $this->valueParser($value) ]);
        }
    }

    private function setPostAttributes(RequestData $requestData)
    {
        foreach ( $_POST ?? [] as $name => $value ) {
            $requestData->add('post', [ 'name' => $name, 'value' => $this->valueParser($value) ]);
        }
    }

    private function valueParser(string $value): string|int|null
    {
        $value = is_numeric($value) ? (int)$value : $value;
        return empty($value) ? null : $value;
    }

    private function setContentType()
    {
        $this->request['content_type'] =
            $this->request_data['HTTP_CONTENT_TYPE'] ??
            $this->request_data['CONTENT_TYPE'] ??
            'GET';
    }

    public function getContentType()
    {
        return $this->request['content_type'];
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
