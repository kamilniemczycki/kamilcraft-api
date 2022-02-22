<?php

namespace KamilCraftApi;

use Exception;
use KamilCraftApi\Exceptions\ApplicationException;
use KamilCraftApi\Interfaces\ControllerInterface;
use KamilCraftApi\Interfaces\RenderInterface;
use KamilCraftApi\Request\Request;
use KamilCraftApi\Router\Router;
use KamilCraftApi\Router\RouterElement;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use ReflectionNamedType;
use stdClass;

class Application
{
    protected Request $request;
    protected Router $router;
    protected ?RouterElement $selectedRouterElement;
    protected string $controller = '';

    public function __construct(
        protected string $envFileConfig
    ) {
        $this->request = new Request($_SERVER);
        $this->router = new Router($this->request);
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

    public function getRouter(): Router
    {
        return $this->router;
    }

    /**
     * @throws Exception
     */
    private function checkParameters(array $controller)
    {
        try {
            $methodParameters = (new ReflectionMethod($controller[0], $controller[1]))->getParameters();
            foreach ($methodParameters as $parameter) {
                if (($type = $parameter->getType()) instanceof ReflectionNamedType) {
                    if (
                        $type->getName() === 'int' &&
                        isset($this->selectedRouterElement->getAttributes()[$parameter->getName()]) &&
                        !is_numeric($this->selectedRouterElement->getAttributes()[$parameter->getName()])
                    ) {
                        throw new Exception('Error type of attribute');
                    }
                }
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    private function selectController()
    {
        $controller = explode('@', $this->controller);
        $controller[1] = $controller[1] ?? '__invoke';
        try {
            if (! class_exists($controller[0]) ) {
                throw new ApplicationException('Class not exists');
            }
            if (! method_exists($controller[0], $controller[1]) ) {
                throw new ApplicationException('Method not exists');
            }
            $this->checkParameters($controller);

            $classController = $this->createClass($controller[0]);
            $loadedController = $this->createMethod($classController, $controller[1]);
            $this->responseRender($loadedController);
        } catch (ApplicationException $e) {
            if ( $this->request->getContentType() === 'application/json' ) {
                (new Response())->json((object)[
                    'message' => 'Server error'
                ], 500)->render();
            } else {
                (new Response())(
                    file_get_contents(ROOT_PATH . 'errors/error500.html'), 500
                )->render();
            }
        } catch (Exception $e) {
            if ( $this->request->getContentType() === 'application/json' ) {
                (new Response())->json((object)[
                    'message' => 'Invalid request'
                ], 400)->render();
            } else {
                (new Response())(
                    file_get_contents(ROOT_PATH . 'errors/error400.html'), 400
                )->render();
            }
        }
    }

    public function run(): void
    {
        $this->router = require ROOT_PATH . 'router.php';

        if ( ! $this->router->requestIsAdded() ) {
            $this->router->setRequest($this->request);
        }

        $selected = $this->getRouter()->selectRouter();

        if ( $selected ) {
            $this->controller = $selected->controller;
            $this->selectedRouterElement = $selected;
            $this->selectController();
        } else {
            if ( $this->request->getContentType() === 'application/json' ) {
                (new Response())->json((object)[
                    'message' => 'Not found'
                ], 404)->render();
            } else {
                (new Response())(
                    file_get_contents(ROOT_PATH . 'errors/error404.html'), 404
                )->render();
            }
        }
    }

    /**
     * @throws ReflectionException
     */
    private function createClass(string $className): ControllerInterface|stdClass
    {
        $parameters = [];
        if ( $classReflection = (new ReflectionClass($className))->getConstructor() ) {
            foreach ($classReflection->getParameters() as $parameter) {
                if (
                    $parameter->getType() instanceof ReflectionNamedType &&
                    $parameter->getType()->getName() === Request::class
                ) {
                    $parameters[$parameter->getName()] = $this->request;
                }
            }
        }
        return new $className(...$parameters);
    }

    /**
     * @throws ReflectionException
     */
    private function createMethod(ControllerInterface|stdClass $controller, string $methodName): mixed
    {
        $reflectionMethod = new ReflectionMethod($controller, $methodName);
        $parameters = $this->selectedRouterElement->getAttributes();
        foreach ( $reflectionMethod->getParameters() as $parameter ) {
            if (
                $parameter->getType() instanceof ReflectionNamedType &&
                $parameter->getType()->getName() === Request::class
            ) {
                $parameters[$parameter->getName()] = $this->request;
            }
        }
        return call_user_func_array([$controller, $methodName], $parameters);
    }

    private function responseRender($loadedController): void
    {
        if($loadedController instanceof RenderInterface) {
            $loadedController->render();
            exit;
        }
    }
}
