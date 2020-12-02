<?php

namespace Concept;

abstract class Distinguishable
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function key(): string
    {
        $name = $this->normalize(static::class);
        return $name . "_" . $this->id;
    }

    private function normalize(string $string): string
    {
        $withoutBackSlash = str_replace('\\', '_', $string);
        return strtolower($withoutBackSlash);
    }
}
