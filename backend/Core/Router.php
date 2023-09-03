<?php

namespace App\Core;

use App\Core\Exceptions\NotFoundException;

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

    public function get(string $path, array | callable $callback): void
    {
        $this->routes['GET'][$path] = $callback;
    }

    public function post(string $path, array | callable $callback): void
    {
        $this->routes['POST'][$path] = $callback;
    }

    /**
     * @throws NotFoundException
     */
    public function callback(string $path, string $method): mixed
    {
        $callback = $this->routes[$method][$path] ?? false;

        if(!$callback) {
            throw new NotFoundException();
        }

        if(is_array($callback)) {
            $callback[0] = new $callback[0];
        }

        // To do - Pass route params
        return $callback($this->request);
    }
}