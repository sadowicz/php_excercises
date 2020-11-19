<?php

namespace Storage;

use PDO;
use Config\Directory;

class SQLiteStorage extends SQLStorage {

    public function __construct() {
        parent::__construct(new PDO("sqlite:".Directory::storage()."/db.sqlite"));
    }
}