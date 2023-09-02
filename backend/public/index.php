<?php

define("ROOT_DIR", dirname(__DIR__));

require_once ROOT_DIR . "/vendor/autoload.php";
require_once ROOT_DIR . "/Core/Utils/Functions.php";


use App\Core\App;

$app = new App();

include_once ROOT_DIR . "/Routes/Api.php";

$app->run();