<?php
namespace Concept;

abstract class Distinguishable {
    private int $id;

    public function __construct(int $id) {
        $this->id = $id;
    }

    public function key() : string {
        return $this->normalize(static::class).'_'.$this->id;
    }

    private function normalize(string $static_class) : string {
        return str_replace('\\', '_', strtolower($static_class));
    }
}