<?php

namespace Storage;

use Concept\Distinguishable;
use Config\Directory;

class FileStorage implements Storage
{
    public function store(Distinguishable $distinguishable) : void
    {
        file_put_contents(Directory::storage() . $distinguishable->key(), serialize($distinguishable));
    }

    public function loadAll(): array
    {
        $ignored = ['..', '.', '.gitignore', 'db.sqlite'];

        $result = [];

        $files = array_diff(scandir(Directory::storage()), $ignored);

        foreach ($files as $file) {
            $result[] = unserialize(file_get_contents(Directory::storage() . $file));
        }

        return $result;
    }
}