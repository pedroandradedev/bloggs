<?php

$router->group("admin", \App\Middlewares\Auth::class);
$router->get("/", "AdminController:dashboard", "admin.dashboard");

$router->group("admin/post", \App\Middlewares\Auth::class);
$router->get("/criar", "PostController:create", "post.create");
$router->post("/criar", "PostController:store", "post.store");
$router->get("/{id}/editar", "PostController:edit", "post.edit");
$router->put("/{id}/editar", "PostController:update", "post.update");
$router->delete("/{id}/delete", "PostController:delete", "post.delete");