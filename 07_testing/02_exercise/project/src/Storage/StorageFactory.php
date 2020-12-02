<?php

namespace Storage;

use Exception;

interface StorageFactory
{
    public function create(string $type): ?Storage;
}