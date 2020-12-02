<?php

namespace Storage;

use Exception;

class StorageFactoryImpl implements StorageFactory
{
    public function create(string $type): ?Storage
    {
        $type = strtolower($type);

        if ($type == "mysql")
            return new MySQLStorage();

        if ($type == "sqlite")
            return new SQLiteStorage();

        if ($type == "file")
            return new FileStorage();

        if ($type == "session")
            return new SessionStorage();

        if ($type == "redis")
            return new RedisStorage();

        return null;
    }
}