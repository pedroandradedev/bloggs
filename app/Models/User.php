<?php

namespace App\Models;

use CoffeeCode\DataLayer\DataLayer;
use PDOException;

class User extends DataLayer
{
    public function __construct()
    {
        parent::__construct("users", ["first_name", "last_name", "email", "password"]);
    }

    public function save(): bool
    {
        if (!$this->validateEmail() || !parent::save()) {
            return false;
        }

        return true;
    }

    public function validatePassword(): bool
    {
        if (empty($this->password) || strlen($this->password) < 6) {
            $this->fail = new PDOException("Informe uma senha com pelo menos 6 caracteres.");
            return false;
        }

        if (password_get_info($this->password)["bloggs"]) {
            return true;
        }

        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return true;
    }

    protected function validateEmail(): bool
    {
        if (empty($this->email) || !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->fail = new PDOException("Informe um e-mail válido");
            return false;
        }

        $usersByEmail = null;
        if (!$this->id) {
            $usersByEmail = $this->find("email = :email", "email={$this->email}")->count();
        } else {
            $usersByEmail = $this->find("email = :email AND id != :id", "email={$this->email}&id={$this->id}")->count();
        }

        if ($usersByEmail) {
            $this->fail = new PDOException("O e-mail informado já está em uso");
            return false;
        }

        return true;
    }
}
