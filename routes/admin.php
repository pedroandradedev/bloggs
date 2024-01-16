<?php

$router->group("admin", \App\Middlewares\Auth::class);
$router->get("/", "AdminController:dashboard", "admin.dashboard");

$router->group("admin/post", \App\Middlewares\Auth::class);
$router->get("/criar", "PostController:create", "post.create");
$router->post("/criar", "PostController:store", "post.store");
$router->get("/{id}/editar", "PostController:edit", "post.edit");
$router->put("/{id}/editar", "PostController:update", "post.update");
$router->delete("/{id}/delete", "PostController:delete", "post.delete");

$router->group("admin/usuarios", \App\Middlewares\Auth::class);
$router->get("/", "UserController:index", "user.index");
$router->get("/criar", "UserController:create", "user.create");
$router->post("/criar", "UserController:store", "user.store");
$router->get("/{id}/editar", "UserController:edit", "user.edit");
$router->put("/{id}/editar", "UserController:update", "user.update");
$router->delete("/{id}/delete", "UserController:delete", "user.delete");