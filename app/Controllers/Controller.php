<?php

namespace KamilCraftApi\App\Controllers;

use KamilCraftApi\Interfaces\ControllerInterface;
use KamilCraftApi\Response;

class Controller implements ControllerInterface
{
    private Response $response;

    public function __construct()
    {
        $this->response = new Response();
    }

    protected function response(): Response
    {
        return $this->response;
    }
}
