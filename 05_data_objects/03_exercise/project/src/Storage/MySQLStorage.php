<?php

namespace Storage;

use PDO;

class MySQLStorage extends SQLStorage {

    public function __construct() {
        parent::__construct(new PDO("mysql:host=127.0.0.1;port=3306;dbname=test", "test", "test123"));
    }
}