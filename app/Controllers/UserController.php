<?php

namespace App\Controllers;

use App\Models\User;
use CoffeeCode\Paginator\Paginator;

class UserController extends Controller
{
    public function index()
    {
        $page = filter_input(INPUT_GET, "page", FILTER_VALIDATE_INT);
        $paginator = new Paginator(
            $this->router->route('user.index', ["page" => ""]),
            "Página",
            [
                "Primeira Página",
                "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"w-4 h-4 min-w-max\"><path d=\"m11 17-5-5 5-5\"/><path d=\"m18 17-5-5 5-5\"/></svg>"
            ],
            [
                "Última Página",
                "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"w-4 h-4 min-w-max\"><path d=\"m6 17 5-5-5-5\"/><path d=\"m13 17 5-5-5-5\"/></svg>"
            ]
        );
        $paginator->pager((new User)->find()->count(), 20, $page, 2);

        $users = (new User)->find()->limit($paginator->limit())->offset($paginator->offset())->fetch(true) ?? [];
        return Controller::view("admin/users/index", compact('users', 'paginator'));
    }

    public function create()
    {
        return Controller::view("admin/users/create");
    }

    public function store($data)
    {
        if (in_array("", [$data["first_name"], $data["last_name"], $data["email"], $data["password"]])) {
            flash("status", "Preencha os campos obrigatórios para criar um novo usuário!", FLASH_ERROR);
            flash("first_name", $data["first_name"], FLASH_INFO);
            flash("last_name", $data["last_name"], FLASH_INFO);
            flash("email", $data["email"], FLASH_INFO);
            return $this->router->redirect("user.create");
        }

        $user = new User();

        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->email = $data['email'];
        $user->password = $data['password'];

        if (!$user->validatePassword()) {
            flash("status", $user->fail()->getMessage(), FLASH_ERROR);
            flash("first_name", $data["first_name"], FLASH_INFO);
            flash("last_name", $data["last_name"], FLASH_INFO);
            flash("email", $data["email"], FLASH_INFO);
            return $this->router->redirect("user.create");
        }

        if (!$user->save()) {
            flash("status", $user->fail()->getMessage(), FLASH_ERROR);
            return $this->router->redirect("user.create");
        }

        flash("status", "Usuário criado com sucesso!", FLASH_SUCCESS);
        return $this->router->redirect("user.index");
    }

    public function edit($data)
    {
        $user = (new User)->findById($data["id"]);
        if (!$user) {
            return (new ErrorController($this->router))->error(404);
        }
        return Controller::view("admin/users/edit", compact('user'));
    }

    public function update($data)
    {
        if (in_array("", [$data["first_name"], $data["last_name"], $data["email"]])) {
            flash("status", "Preencha os campos obrigatórios para alterar os dados do usuário!", FLASH_ERROR);
            flash("first_name", $data["first_name"], FLASH_INFO);
            flash("last_name", $data["last_name"], FLASH_INFO);
            flash("email", $data["email"], FLASH_INFO);
            return $this->router->redirect("user.edit", ["id" => $data["id"]]);
        }

        $user = (new User)->findById($data["id"]);
        if (!$user) {
            return (new ErrorController($this->router))->error(404);
        }

        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->email = $data['email'];

        if ($data['password']) {
            $user->password = $data['password'];
            if (!$user->validatePassword()) {
                flash("status", $user->fail()->getMessage(), FLASH_ERROR);
                flash("first_name", $data["first_name"], FLASH_INFO);
                flash("last_name", $data["last_name"], FLASH_INFO);
                flash("email", $data["email"], FLASH_INFO);
                return $this->router->redirect("user.edit", ["id" => $data["id"]]);
            }
        }

        if (!$user->save()) {
            flash("status", $user->fail()->getMessage(), FLASH_ERROR);
            flash("first_name", $data["first_name"], FLASH_INFO);
            flash("last_name", $data["last_name"], FLASH_INFO);
            flash("email", $data["email"], FLASH_INFO);
            return $this->router->redirect("user.edit", ["id" => $data["id"]]);
        }

        flash("status", "Os dados do usuário foram alterados com sucesso!", FLASH_SUCCESS);
        return $this->router->redirect("user.index");
    }

    public function delete($data)
    {
        $user = (new User)->findById($data["id"]);
        if (!$user) {
            flash("status", "Os dados do usuário não foram encontrados!", FLASH_ERROR);
            return $this->router->redirect("user.index");
        }

        if ($user->id == $_SESSION['bloggs:user']) {
            flash("status", "Você não pode excluir o seu próprio usuário!", FLASH_ERROR);
            return $this->router->redirect("user.index");
        }

        if (!$user->destroy()) {
            flash("status", $user->fail()->getMessage(), FLASH_ERROR);
            return $this->router->redirect("user.index");
        }

        flash("status", "O usuário foi excluído com sucesso!", FLASH_SUCCESS);
        return $this->router->redirect("user.index");
    }
}
