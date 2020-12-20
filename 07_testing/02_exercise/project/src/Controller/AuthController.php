<?php

namespace Controller;

use Model\User;

class AuthController extends Controller
{
    public function register()
    {
        return ["auth.register", ["title" => "Register"]];
    }

    public function confirmation_notice()
    {
        return ["auth.confirmation_notice", ["title" => "Confirmation notice"]];
    }
}