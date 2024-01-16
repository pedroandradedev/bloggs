<?php
ob_start();
session_start();

require_once __DIR__ . "/vendor/autoload.php";

use App\Controllers\ErrorController;
use CoffeeCode\Router\Router;

$router = new Router(site());
$router->namespace("App\Controllers");

require_once "routes/admin.php";
require_once "routes/auth.php";
require_once "routes/web.php";

$router->dispatch();

if ($router->error()) {
    (new ErrorController($router))->error($router->error());
}

ob_end_flush();
