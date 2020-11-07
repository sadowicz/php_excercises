<?php
namespace Storage;

use Concept\Distinguishable;
use Config\Directory;

class FileStorage implements Storage {
    public function  store(Distinguishable $item) {
        file_put_contents(Directory::storge().$item->key(), serialize($item));
    }

    public function loadAll(): array {
        $items = array();
        $stored_items = glob(Directory::storge().'widget_{button,link}_*', GLOB_BRACE);

        foreach($stored_items as $stored_item) {
            $item = unserialize(file_get_contents($stored_item));
            array_push($items, $item);
        }

        return $items;
    }
}