<?php

$router->group(null);
$router->get("/", "WebController:home", "web.home");
$router->get("/post/{id}", "WebController:post", "web.post");
$router->get("/blog", "WebController:blog", "web.blog");