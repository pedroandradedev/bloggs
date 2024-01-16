<?php

namespace App\Controllers;

use App\Models\Post;
use CoffeeCode\Paginator\Paginator;

class WebController extends Controller
{
    public function home() {
        $posts = (new Post)->find()->limit(4)->fetch(true);
        return Controller::view("web/home", compact('posts'));
    }

    public function post($data) {
        $post = (new Post)->find("id = :i", "i={$data["id"]}")->fetch();
        if (!$post) {
            return (new ErrorController($this->router))->error(404);
        }
        return Controller::view("web/post", compact('post'));
    }

    public function blog($data) {
        $page = filter_input(INPUT_GET, "page", FILTER_VALIDATE_INT);
        $paginator = new Paginator($this->router->route('web.blog', [ "page" => "" ]),
        "Página",
        [
            "Primeira Página",
            "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"w-4 h-4 min-w-max\"><path d=\"m11 17-5-5 5-5\"/><path d=\"m18 17-5-5 5-5\"/></svg>"
        ],
        [
            "Última Página",
            "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"w-4 h-4 min-w-max\"><path d=\"m6 17 5-5-5-5\"/><path d=\"m13 17 5-5-5-5\"/></svg>"
        ]);
        $paginator->pager((new Post)->find()->count(), 12, $page, 2);

        $posts = (new Post)->find()->limit($paginator->limit())->offset($paginator->offset())->fetch(true);
        return Controller::view("web/blog", compact('posts', 'paginator'));
    }
}