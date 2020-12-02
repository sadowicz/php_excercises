<?php

namespace Controller;

use Storage\Storage;
use Storage\StorageFactory;
use Exception;
use Log;

class Controller
{
    private StorageFactory $storageFactory;

    public function __construct(StorageFactory $storageFactory)
    {
        $this->storageFactory = $storageFactory;
    }

    protected function storage(string $type = "mysql"): ?Storage
    {
        try {
            return $this->storageFactory->create($type);
        } catch (Exception $e) {
            Log::error("Failed to create '$type' storage.");
            return null;
        }
    }
}
