<?php

namespace App\Middlewares;

use CoffeeCode\Router\Router;

class Auth
{
    public function handle(Router $router): bool
    {
        if (isset($_SESSION["bloggs:user"]) && $_SESSION["bloggs:user"] != "") {
            return true;
        }
        return $router->redirect("auth.login");
    }
}