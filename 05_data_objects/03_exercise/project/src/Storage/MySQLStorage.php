<?php

namespace Storage;

use Concept\Distinguishable;
use PDO;

class MySQLStorage implements Storage {

    private PDO $pdo;
    private \PDOStatement $insert;

    public function __construct() {
        $this->pdo = new PDO("mysql:host=127.0.0.1;port=3306;dbname=test", "test", "test123");
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->pdo->exec('CREATE TABLE IF NOT EXISTS objects (`key` VARCHAR(50) PRIMARY KEY, `data` TEXT)');
        $this->pdo->exec('DELETE FROM objects');

        $this->insert = $this->pdo->prepare("INSERT INTO objects VALUES (:key, :data)");
    }

    public function store(Distinguishable $distinguishable) : void {
        $this->insert->bindValue('key', $distinguishable->key());
        $this->insert->bindValue('data', serialize($distinguishable));
        $this->insert->execute();
    }

    public function loadAll(): array {
        $query = $this->pdo->query("SELECT `data` FROM objects");
        return $query->fetchAll(PDO::FETCH_FUNC, "unserialize");
    }
}