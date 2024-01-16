<?php

namespace App\Middlewares;

use CoffeeCode\Router\Router;

class Guest
{
    public function handle(Router $router): bool
    {
        if (!isset($_SESSION["blog:user"]) || $_SESSION["blog:user"] == "") {
            return true;
        }
        return $router->redirect("admin.dashboard");
    }
}