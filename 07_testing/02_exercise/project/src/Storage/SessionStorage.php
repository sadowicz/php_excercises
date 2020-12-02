<?php

namespace Storage;

use Concept\Distinguishable;

class SessionStorage implements Storage
{
    public function store(Distinguishable $distinguishable): void
    {
        $key = $distinguishable->key();
        $_SESSION[$key] = serialize($distinguishable);
    }

    public function loadAll(): array
    {
        return $this->load('*');
    }

    public function load(string $pattern): array
    {
        $result = [];
        foreach ($_SESSION as $key => $value) {
            if (fnmatch($pattern, $key)) {
                $result[] = unserialize($value);
            }
        }
        return $result;
    }

    public function remove(string $key): void
    {
        unset($_SESSION[$key]);
    }
}