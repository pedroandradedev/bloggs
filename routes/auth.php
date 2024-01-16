<?php

$router->group("admin", \App\Middlewares\Guest::class);
$router->get("/login", "AuthController:login", "auth.login");
$router->post("/login", "AuthController:store", "auth.store");

$router->group(null, \App\Middlewares\Auth::class);
$router->get("/logout", "AuthController:logout", "auth.logout");