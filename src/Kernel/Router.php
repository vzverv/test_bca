<?php

declare(strict_types=1);

namespace App\Kernel;

final class Router
{
    /**
     * @var array
     */
    private $routes;

    /**
     * Execute wired controller.
     */
    final public function route()
    {
        $uri = explode('?', $_SERVER['REQUEST_URI']);

        $requestBody = file_get_contents('php://input');
        $body = json_decode($requestBody, true);

        if (empty($_REQUEST)) {
            $_REQUEST = $body['params'] ?? [];
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $body['_method'] === 'delete') {
            $_SERVER['REQUEST_METHOD'] = 'DELETE';
        }

        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $v) {

            if (isset($uri[0]) && ($uri[0] === $v['uri'])) {
                $v['callable']();
            }
        }
    }

    /**
     * @param string $uri
     * @param callable $invokable
     */
    final public function get(string $uri, callable $invokable)
    {
        $this->addRoute('GET', $uri, $invokable);
    }

    /**
     * @param string $uri
     * @param callable $invokable
     */
    final public function post(string $uri, callable $invokable)
    {
        $this->addRoute('POST', $uri, $invokable);
    }

    /**
     * @param string $uri
     * @param callable $invokable
     */
    final public function delete(string $uri, callable $invokable)
    {
        $this->addRoute('DELETE', $uri, $invokable);
    }

    /**
     * @param string $method
     * @param string $uri
     * @param callable $invokable
     */
    private function addRoute(string $method, string $uri, callable $invokable)
    {
        if (!in_array($method, ['GET', 'POST', 'DELETE', 'PUT']))
        {
            throw new \InvalidArgumentException('Method is not allowed');
        }

        $this->routes[$method][] = ['uri' => $uri, 'callable' => $invokable];
    }
}
