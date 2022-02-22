<?php

namespace KamilCraftApi;

use KamilCraftApi\Interfaces\RenderInterface;

class Response implements RenderInterface
{
    protected int $http_code = 200;
    protected string $content_type = 'text/html';
    protected string $body_content = '';

    public function __construct(
        protected string $charset = 'utf-8'
    )
    {}

    public function json(object|array $response, int $http_code = 200): Response
    {
        $this->http_code = $http_code;
        $this->content_type = 'application/json';
        $this->body_content = json_encode($response);

        return $this;
    }

    private function html(string $body_content = '', int $http_code = 200): Response
    {
        $this->http_code = $http_code;
        $this->content_type = 'text/html';
        $this->body_content = $body_content;

        return $this;
    }

    private function responseHeader(): void
    {
        http_response_code($this->http_code);
        header('Content-Type: '. $this->content_type .'; charset='. $this->charset);
    }

    public function render(): void
    {
        $this->responseHeader();
        echo $this->body_content;
    }

    public function __invoke(string $body_content = '', int $http_code = 200): Response
    {
        return $this->html($body_content, $http_code);
    }
}
