<?php

namespace App\Core;

use App\Core\Abstractions\Response;
use App\Core\Exceptions\AppError;

class App
{
    public static App $app;

    public Router $router;

    public Request $request;

    public function __construct()
    {
        self::$app = $this;

        $this->request = new Request();
        $this->router = new Router($this->request);
    }

    public function run(): void
    {
        try {

            $this->router->resolve();

        } catch (\Throwable $t) {
            if ($t instanceof AppError ) {
                Response::error($t, $t->getCode());
            } else {
                Response::error($t);
            }
        }
    }
}