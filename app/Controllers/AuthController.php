<?php

namespace App\Controllers;

use App\Models\User;

class AuthController extends Controller
{
    public function login() {
        return Controller::view("auth/login");
    }

    public function store($data) {
        $email = filter_var($data["email"], FILTER_VALIDATE_EMAIL);
        $password = filter_var($data["password"], FILTER_DEFAULT);

        if (!$email || !$password) {
          return ajax([
            "type" => "alert",
            "message" => "Informe seu e-mail e senha para entrar!"
          ]);
        }

        $user = (new User())->find("email = :e", "e={$email}")->fetch();
        if (!$user || !password_verify($password, $user->password)) {
          return ajax([
            "type" => "error",
            "message" => "E-mail ou senha incorretos!"
          ]);
        }

        $_SESSION["blog:user"] = $user->id;
        echo ajax([
          "redirect" => $this->router->route("admin.dashboard")
        ]);
    }

    public function logout() {
        unset($_SESSION["blog:user"]);
        return $this->router->redirect("auth.login");
    }
}