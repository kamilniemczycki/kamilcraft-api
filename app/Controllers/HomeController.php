<?php

namespace KamilCraftApi\App\Controllers;

use KamilCraftApi\Interfaces\ControllerInterface;
use KamilCraftApi\Request\Request;
use KamilCraftApi\Response;

class HomeController implements ControllerInterface
{
    public function __invoke(Request $request): Response
    {
        return (new Response())->json((object)[
            'message' => 'Hello World'
        ]);
    }
}
