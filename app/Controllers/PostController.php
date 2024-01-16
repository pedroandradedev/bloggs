<?php

namespace App\Controllers;

use App\Models\Post;
use CoffeeCode\Uploader\Image;

class PostController extends Controller
{
    public function create()
    {
        return Controller::view("admin/posts/create");
    }

    public function store($data)
    {
        if (in_array("", [$data["title"], $data["description"]])) {
            flash("status", "Preencha os campos obrigatórios para criar um novo post!", FLASH_ERROR);
            flash("title", $data["title"], FLASH_INFO);
            flash("description", $data["description"], FLASH_INFO);
            return $this->router->redirect("post.create");
        }

        $post = new Post();

        $post->title = $data['title'];
        $post->description = $data['description'];

        $Upload = new Image("assets/images", "posts");
        $files = $_FILES;

        $file = !empty($files["image"]) ? $files["image"] : null;

        if ($file && $file["name"]) {
            if (empty($file["type"]) || !in_array($file["type"], $Upload::isAllowed())) {
                flash("status", "Selecione uma imagem válida!", FLASH_WARNING);
                return $this->router->redirect("post.create");
            } else {
                $uploaded = $Upload->upload($file, pathinfo($file["name"], PATHINFO_FILENAME), 1000);
                if (!$uploaded) {
                    flash("status", $post->fail()->getMessage(), FLASH_ERROR);
                    return $this->router->redirect("post.create");
                }
                $post->image = $uploaded;
            }
        }

        if (!$post->save()) {
            flash("status", $post->fail()->getMessage(), FLASH_ERROR);
            return $this->router->redirect("post.create");
        }

        flash("status", "Post criado com sucesso!", FLASH_SUCCESS);
        return $this->router->redirect("admin.dashboard");
    }

    public function edit($data)
    {
        $post = (new Post)->find("id = :i", "i={$data["id"]}")->fetch();
        if (!$post) {
            return (new ErrorController($this->router))->error(404);
        }
        return Controller::view("admin/posts/edit", compact('post'));
    }

    public function update($data)
    {
        if (in_array("", [$data["title"], $data["description"]])) {
            flash("status", "Preencha os campos obrigatórios para alterar os dados do post!", FLASH_ERROR);
            flash("title", $data["title"], FLASH_INFO);
            flash("description", $data["description"], FLASH_INFO);
            return $this->router->redirect("post.edit", ["id" => $data["id"]]);
        }

        $post = (new Post)->find("id = :i", "i={$data["id"]}")->fetch();
        if (!$post) {
            return (new ErrorController($this->router))->error(404);
        }

        $post->title = $data['title'];
        $post->description = $data['description'];

        $Upload = new Image("assets/images", "posts");
        $files = $_FILES;

        $file = !empty($files["image"]) ? $files["image"] : null;

        if ($file && $file["name"]) {
            if (empty($file["type"]) || !in_array($file["type"], $Upload::isAllowed())) {
                flash("status", "Selecione uma imagem válida!", FLASH_WARNING);
                flash("title", $data["title"], FLASH_INFO);
                flash("description", $data["description"], FLASH_INFO);
                return $this->router->redirect("post.edit", ["id" => $data["id"]]);
            } else {
                if ($post->image && $post->image != "" && file_exists($post->image)) {
                    unlink($post->image);
                }
                $uploaded = $Upload->upload($file, pathinfo($file["name"], PATHINFO_FILENAME), 1000);
                if (!$uploaded) {
                    flash("status", $post->fail()->getMessage(), FLASH_ERROR);
                    flash("title", $data["title"], FLASH_INFO);
                    flash("description", $data["description"], FLASH_INFO);
                    return $this->router->redirect("post.edit", ["id" => $data["id"]]);
                }
                $post->image = $uploaded;
            }
        }

        if (!$post->save()) {
            flash("status", $post->fail()->getMessage(), FLASH_ERROR);
            flash("title", $data["title"], FLASH_INFO);
            flash("description", $data["description"], FLASH_INFO);
            return $this->router->redirect("post.edit", ["id" => $data["id"]]);
        }

        flash("status", "Os dados do post foram alterados com sucesso!", FLASH_SUCCESS);
        return $this->router->redirect("admin.dashboard");
    }

    public function delete($data)
    {
        $post = (new Post)->find("id = :i", "i={$data["id"]}")->fetch();
        if (!$post) {
            flash("status", "Os dados do post não foram encontrados!", FLASH_ERROR);
            return $this->router->redirect("admin.dashboard");
        }

        if (!$post->destroy()) {
            flash("status", $post->fail()->getMessage(), FLASH_ERROR);
            return $this->router->redirect("admin.dashboard");
        }

        if ($post->image && file_exists($post->image)) {
            unlink($post->image);
        }

        flash("status", "O post foi excluído com sucesso!", FLASH_SUCCESS);
        return $this->router->redirect("admin.dashboard");
    }
}
