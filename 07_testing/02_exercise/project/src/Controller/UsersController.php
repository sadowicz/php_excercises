<?php

namespace Controller;

class UsersController extends Controller
{
    private array $example_users = [
        1 => [
            'name' => 'John',
            'surname' => 'Doe',
            'age' => 21
        ],
        2 => [
            'name' => 'Peter',
            'surname' => 'Bauer',
            'age' => 16
        ],
        3 => [
            'name' => 'Paul',
            'surname' => 'Smith',
            'age' => 18
        ]
    ];

    public function index()
    {
        return ["users.index", ["title" => "Users", "users" => $this->example_users]];
    }

    public function show($id)
    {
        $user = $this->example_users[$id];
        return ["users.show", ["title" => $user['name'], "user" => $user]];
    }
}
