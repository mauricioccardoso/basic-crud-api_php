<?php

namespace App\Core\Abstractions;

use App\Core\App;

class Route
{
    public static function get(string $path, array | callable $callback): void
    {
        App::$app->router->get($path, $callback);
    }

    public static function post(string $path, array | callable $callback): void
    {
        App::$app->router->post($path, $callback);
    }
}