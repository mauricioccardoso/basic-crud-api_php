<?php

namespace App\Core;

class Router
{
    public array $routes = [];

    public function __construct(
        public Request $request
    ) {}

    public function resolve()
    {
        $path = $this->request->path();
        $method = $this->request->method();

        return $this->callback($path, $method);
    }

    public function get(string $path, callable $callback): void
    {
        $this->routes['GET'][$path] = $callback;
    }

    public function post(string $path, callable $callback): void
    {
        $this->routes['POST'][$path] = $callback;
    }

    public function callback(string $path, string $method): mixed
    {
        $callback = $this->routes[$method][$path] ?? false;

        if(!$callback) {
            return 'Not found';
        }

        if(is_array($callback)) {
            $callback[0] = new $callback[0];
        }

        return $callback($this->request);
    }
}