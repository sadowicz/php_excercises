<?php

namespace Model;

use Concept\Distinguishable;

class User extends Distinguishable
{
    public string $name;
    public string $surname;
    public string $email;
    public string $password;

    public bool $confirmed;
    public string $token;

    public function __construct(int $id, string $name, string $surname, string $email, string $password) {

        parent::__construct($id);
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->password = $password;
        $this->confirmed = false;
        $this->token = bin2hex(random_bytes(16));
    }

    /*public function name() {

        return $this->name;
    }

    public function surname() {

        return $this->surname;
    }

    public function email() {

        return $this->email;
    }

    public function password() {

        return $this->password;
    }*/
}