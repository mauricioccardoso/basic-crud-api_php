<?php

define("ROOT_DIR", dirname(__DIR__));

require_once ROOT_DIR . "/vendor/autoload.php";
require_once ROOT_DIR . "/Core/Utils/Functions.php";

use App\Core\Abstractions\Response;
use App\Core\App;

set_exception_handler(function (\Throwable $t) {
    Response::error($t);
});

$dotenv = Dotenv\Dotenv::createImmutable(ROOT_DIR);
$dotenv->load();


$app = new App();

include_once ROOT_DIR . "/Routes/Api.php";

$app->run();