<?php

namespace Storage;

use Concept\Distinguishable;
use Config\Directory;

class FileStorage implements Storage
{
    public function store(Distinguishable $distinguishable): void
    {
        file_put_contents(Directory::storage() . $distinguishable->key(), serialize($distinguishable));
    }

    public function loadAll(): array
    {
        return $this->load('*');
    }

    public function load(string $pattern): array
    {
        $ignored = ['..', '.', '.gitignore', 'db.sqlite', 'app.log'];

        $result = [];

        $files = array_diff(scandir(Directory::storage()), $ignored);

        foreach ($files as $file) {
            if (fnmatch($pattern, $file)) {
                $result[] = unserialize(file_get_contents(Directory::storage() . $file));
            }
        }

        return $result;
    }

    public function remove(string $key): void
    {
        unlink(Directory::storage() . $key);
    }
}