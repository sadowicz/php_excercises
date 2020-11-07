<?php
namespace Storage;

use Concept\Distinguishable;

interface Storage {
    public function store(Distinguishable $item);
    public function loadAll() : array;
}