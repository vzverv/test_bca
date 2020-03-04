<?php

declare(strict_types=1);

namespace App\Utilities;

final class Router
{
    /**
     * @param string $route
     * @param callable $invokable
     */
    final private function route(string $route, callable $invokable)
    {
        if ($_SERVER['REQUEST_URI'] === $route) {

            $invokable();
        }
    }

    /**
     * @param string $route
     * @param callable $invokable
     */
    final public function get(string $route, callable $invokable)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->route($route, $invokable);
        }
    }

    /**
     * @param string $route
     * @param callable $invokable
     */
    final public function post(string $route, callable $invokable)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->route($route, $invokable);
        }
    }
}
