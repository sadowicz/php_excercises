<?php

namespace Storage;

use Concept\Distinguishable;

class SessionStorage implements Storage {
    public function __construct() {
        session_start();
        $_SESSION["storage"] = [];
    }

    public function store(Distinguishable $distinguishable) : void {
        $_SESSION["storage"][$distinguishable->key()] = serialize($distinguishable);
    }

    public function loadAll(): array {
        $result = [];

        foreach ($_SESSION["storage"] as $stored) {
            $result[] = unserialize($stored);
        }

        return $result;
    }
}