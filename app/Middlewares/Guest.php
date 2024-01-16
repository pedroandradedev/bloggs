<?php

namespace App\Middlewares;

use CoffeeCode\Router\Router;

class Guest
{
    public function handle(Router $router): bool
    {
        if (!isset($_SESSION["bloggs:user"]) || $_SESSION["bloggs:user"] == "") {
            return true;
        }
        return $router->redirect("admin.dashboard");
    }
}