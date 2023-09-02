<?php

namespace App\Core;

class Request
{
    public array $routeParam = [];

    public function path(): mixed
    {
        return $_SERVER['PATH_INFO'] ?? '/';
    }

    public function method(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function query(): array
    {
        $query = [];
        if ($this->method() === 'GET') {
            foreach ($_GET as $key => $value) {
                $query[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $query;
    }

    public function body(): array
    {
        $body = [];
        if($this->method() === 'POST') {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $body;
    }
}